<?php

namespace App\Http\Controllers\ReturnedIncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoice;
use App\Http\Requests\ReturnedIncomingInvoice\StoreReturnedIncomingInvoiceRequest;
use App\Http\Requests\ReturnedIncomingInvoice\UpdateReturnedIncomingInvoiceRequest;
use App\Models\Cash\Cash;
use App\Models\Kit\Kit;
use App\Models\People\People;
use App\Models\Product\Product;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceAttachment;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceContent;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceImage;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceNote;
use App\Models\Warehouse\Warehouse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ReturnedIncomingInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('ReturnedIncomingInvoice/Index', [
            "ReturnedIncomingInvoice" => ReturnedIncomingInvoice::with('user', 'people', 'warehouse')->orderBy('date', 'desc')->latest()->when(
                Request::input('search'),
                function ($query, $search) {
                    $query->where('number', 'like', "%{$search}%")
                        ->orWhere('date', 'like', "%{$search}%")
                        ->orWhereRelation('warehouse', 'name', 'like', "%{$search}%")
                        ->orWhereRelation('people', 'name', 'like', "%{$search}%");
                }
            )->paginate(35)->withQueryString(),

            'filters' => Request::only(['search']),
            'totalReturnedIncomingInvoice' => ReturnedIncomingInvoice::count(),
            'totalReturnedIncomingInvoiceThisDay' => ReturnedIncomingInvoice::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->count(),
            'totalReturnedIncomingInvoiceThisWeek' => ReturnedIncomingInvoice::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->count(),
            'totalReturnedIncomingInvoiceThisMonth' => ReturnedIncomingInvoice::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->count(),
            'totalReturnedIncomingInvoiceThisYear' => ReturnedIncomingInvoice::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('ReturnedIncomingInvoice/Create', [
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReturnedIncomingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedIncomingInvoiceRequest $request)
    {
        $totalPrice = 0;
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++)
                $totalPrice = $totalPrice + ($request["content"][$i]["price"] * $request["content"][$i]["quantity"]);
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++)
                $totalPrice = $totalPrice + ($request["kit"][$i]["price"] * $request["kit"][$i]["quantity"]);

        $totalPrice = $totalPrice - $request->discount;
        // Save the Incoming Invoice
        $invice = ReturnedIncomingInvoice::create([
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_id,
            'discount' => $request->discount,
            'date' => Carbon::parse($request->date),
            'people_id' => $request->people_id,
            'warehouse_id' => $request->warehouse_id,
            'total' => $totalPrice,
            'user_id' => Auth::id()
        ]);

        if ($request->cash_id) {
            $cash = Cash::find($request->cash_id);
            $cash->available = $cash->available -  $totalPrice;
            $cash->save();
        } else {
            $people = People::find($request->people_id);
            $people->balance = $people->balance +  $totalPrice;
            $people->save();
        }


        // Save The Content Of Incoming Invoice
        if (!is_null($request["content"])) {
            for ($i = 0; $i <  count($request["content"]); $i++) {
                ReturnedIncomingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'returned_incoming_invoice_id' => $invice['id'],
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $product = Product::find($request["content"][$i]["product_id"]);
                $product->stock = $product->stock - $request["content"][$i]["quantity"];
                $product->save();
            }
        }

        // Save The Kit Of Incoming Invoice
        if (!is_null($request["kit"])) {
            for ($i = 0; $i <  count($request["kit"]); $i++) {
                ReturnedIncomingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'returned_incoming_invoice_id' => $invice['id'],
                    'people_id' => $request->people_id,
                    'user_id' => Auth::id(),
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $kit = Kit::find($request["kit"][$i]["kit_id"]);
                $kit->stock = $kit->stock - $request["kit"][$i]["quantity"];
                $kit->save();
            }
        }

        return redirect()->route('returned-incoming-invoice.show', $invice['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoice  $returnedIncomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedIncomingInvoice $returnedIncomingInvoice)
    {
        return Inertia::render('ReturnedIncomingInvoice/Show', [
            "returnedIncomingInvoice" => ReturnedIncomingInvoice::where('id', $returnedIncomingInvoice->id)->with('user', 'people', 'warehouse', 'cash')->get(),

            "returnedIncomingInvoiceContent" => ReturnedIncomingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('returned_incoming_invoice_id',  $returnedIncomingInvoice->id)->get(),

            "returnedIncomingInvoiceKit" => ReturnedIncomingInvoiceKit::with(
                'kit',
                'kit.product',
                'kit.product.product_country',
                'kit.product.product_material',
                'kit.product.product_color',
                'kit.product.product_model',
                'kit.product.product_collection',
                'kit.product.product_brand',
                'kit.product.product_type',
                'kit.product.product_category',
                'kit.product_country',
                'kit.product_material',
                'kit.product_color',
                'kit.product_model',
                'kit.product_collection',
                'kit.product_brand',
                'kit.product_type',
                'kit.product_category'
            )->where('returned_incoming_invoice_id',  $returnedIncomingInvoice->id)->get(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedIncomingInvoice  $returnedIncomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnedIncomingInvoice $returnedIncomingInvoice)
    {
        return Inertia::render('ReturnedIncomingInvoice/Create', [
            "returnedIncomingInvoice" => ReturnedIncomingInvoice::where('id', $returnedIncomingInvoice->id)->get(),
            "returnedIncomingInvoiceContent" => ReturnedIncomingInvoiceContent::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->get(),
            "returnedIncomingInvoiceKit" => ReturnedIncomingInvoiceKit::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
            "suppliers" => People::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedIncomingInvoiceRequest  $request
     * @param  \App\Models\ReturnedIncomingInvoice  $returnedIncomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedIncomingInvoiceRequest $request,ReturnedIncomingInvoice $returnedIncomingInvoice)
    {
        $totalPrice = 0;
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++)
                $totalPrice = $totalPrice + ($request["content"][$i]["price"] * $request["content"][$i]["quantity"]);
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++)
                $totalPrice = $totalPrice + ($request["kit"][$i]["price"] * $request["kit"][$i]["quantity"]);

        // Undo The Blance of invoice
        if ($returnedIncomingInvoice->cash_id) {
            $cash = Cash::find($returnedIncomingInvoice->cash_id);
            $cash->available = $cash->available +  $returnedIncomingInvoice->total;
            $cash->save();
        } else {
            $people = People::find($returnedIncomingInvoice->people_id);
            $people->balance = $people->balance -  $returnedIncomingInvoice->total;
            $people->save();
        }

        $oldContent = ReturnedIncomingInvoiceContent::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->get();
        for ($i = 0; $i <  count($oldContent); $i++) {
            $product = Product::find($oldContent[$i]["product_id"]);
            $product->stock = $product->stock + $oldContent[$i]["quantity"];
            $product->save();
        }

        $oldKit = ReturnedIncomingInvoiceKit::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->get();
        for ($i = 0; $i <  count($oldKit); $i++) {
            $kit = Kit::find($oldKit[$i]["kit_id"]);
            $kit->stock = $kit->stock + $oldKit[$i]["quantity"];
            $kit->save();
        }


        $totalPrice = $totalPrice - $request->discount;
        // Make The Blance Agane
        if ($request->pay_type) {
            $cash = Cash::find($request->cash_id);
            $cash->available = $cash->available -  $totalPrice;
            $cash->save();
        } else {
            $people = People::find($request->people_id);
            $people->balance = $people->balance +  $totalPrice;
            $people->save();
        }

        $returnedIncomingInvoice->pay_type = $request->pay_type;
        $returnedIncomingInvoice->cash_id = $request->cash_id;
        $returnedIncomingInvoice->discount = $request->discount;
        $returnedIncomingInvoice->date = $request->date;
        $returnedIncomingInvoice->total = $totalPrice;
        $returnedIncomingInvoice->people_id = $request->people_id;
        $returnedIncomingInvoice->warehouse_id = $request->warehouse_id;
        $returnedIncomingInvoice->save();
        ReturnedIncomingInvoiceContent::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->delete();
        ReturnedIncomingInvoiceKit::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->delete();

        // Save The Content Of Incoming Invoice
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++) {
                ReturnedIncomingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'returned_incoming_invoice_id' => $returnedIncomingInvoice['id'],
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $product = Product::find($request["content"][$i]["product_id"]);
                $product->stock = $product->stock - $request["content"][$i]["quantity"];
                $product->save();
            }


        // Save The Kit Of Incoming Invoice
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++) {
                ReturnedIncomingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'returned_incoming_invoice_id' => $returnedIncomingInvoice['id'],
                    'people_id' => $request->people_id,
                    'user_id' => Auth::id(),
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $kit = Kit::find($request["kit"][$i]["kit_id"]);
                $kit->stock = $kit->stock - $request["kit"][$i]["quantity"];
                $kit->save();
            }

        return redirect()->route('returned-incoming-invoice.show', $returnedIncomingInvoice['id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedIncomingInvoice  $returnedIncomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedIncomingInvoice $returnedIncomingInvoice)
    {

        // Undo The Blance of invoice
        if ($returnedIncomingInvoice->cash_id) {
            $cash = Cash::find($returnedIncomingInvoice->cash_id);
            $cash->available = $cash->available -  $returnedIncomingInvoice->total;
            $cash->save();
        } else {
            $people = People::find($returnedIncomingInvoice->people_id);
            $people->balance = $people->balance +  $returnedIncomingInvoice->total;
            $people->save();
        }

        $oldContent = ReturnedIncomingInvoiceContent::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->get();
        for ($i = 0; $i <  count($oldContent); $i++) {
            $product = Product::find($oldContent[$i]["product_id"]);
            $product->stock = $product->stock + $oldContent[$i]["quantity"];
            $product->save();
        }

        $oldKit = ReturnedIncomingInvoiceKit::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->get();
        for ($i = 0; $i <  count($oldKit); $i++) {
            $kit = Kit::find($oldKit[$i]["kit_id"]);
            $kit->stock = $kit->stock + $oldKit[$i]["quantity"];
            $kit->save();
        }

        ReturnedIncomingInvoiceContent::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->delete();
        ReturnedIncomingInvoiceKit::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->delete();
        ReturnedIncomingInvoiceNote::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->delete();

        $images  = ReturnedIncomingInvoiceImage::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->get();
        for ($i = 0; $i <  count($images); $i++) {
            Storage::delete("public/" . $images[$i]["image"]);
        }
        ReturnedIncomingInvoiceImage::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->delete();

        $attachment  = ReturnedIncomingInvoiceAttachment::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->get();
        for ($i = 0; $i <  count($images); $i++) {
            Storage::delete("public/" . $attachment[$i]["attachment"]);
        }
        ReturnedIncomingInvoiceImage::where('returned_incoming_invoice_id', $returnedIncomingInvoice->id)->delete();

        $returnedIncomingInvoice->delete();

        return Redirect::route('returned-incoming-invoice.index');
    }
}
