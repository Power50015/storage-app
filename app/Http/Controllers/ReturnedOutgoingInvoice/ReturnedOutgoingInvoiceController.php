<?php

namespace App\Http\Controllers\ReturnedOutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoice;
use App\Http\Requests\ReturnedOutgoingInvoice\StoreReturnedOutgoingInvoiceRequest;
use App\Http\Requests\ReturnedOutgoingInvoice\UpdateReturnedOutgoingInvoiceRequest;
use App\Models\Cash\Cash;
use App\Models\Kit\Kit;
use App\Models\People\People;
use App\Models\Product\Product;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceAttachment;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceContent;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceImage;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceNote;
use App\Models\Warehouse\Warehouse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;


class ReturnedOutgoingInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('ReturnedOutgoingInvoice/Index', [
            "ReturnedOutgoingInvoice" => ReturnedOutgoingInvoice::with('user', 'people', 'warehouse')->orderBy('date', 'desc')->latest()->when(
                Request::input('search'),
                function ($query, $search) {
                    $query->where('number', 'like', "%{$search}%")
                        ->orWhere('date', 'like', "%{$search}%")
                        ->orWhereRelation('warehouse', 'name', 'like', "%{$search}%")
                        ->orWhereRelation('people', 'name', 'like', "%{$search}%");
                }
            )->paginate(35)->withQueryString(),

            'filters' => Request::only(['search']),
            'totalReturnedOutgoingInvoice' => ReturnedOutgoingInvoice::count(),
            'totalReturnedOutgoingInvoiceThisDay' => ReturnedOutgoingInvoice::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->count(),
            'totalReturnedOutgoingInvoiceThisWeek' => ReturnedOutgoingInvoice::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->count(),
            'totalReturnedOutgoingInvoiceThisMonth' => ReturnedOutgoingInvoice::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->count(),
            'totalReturnedOutgoingInvoiceThisYear' => ReturnedOutgoingInvoice::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('ReturnedOutgoingInvoice/Create', [
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReturnedOutgoingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReturnedOutgoingInvoiceRequest $request)
    {
        $totalPrice = 0;
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++)
                $totalPrice = $totalPrice - ($request["content"][$i]["price"] * $request["content"][$i]["quantity"]);
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++)
                $totalPrice = $totalPrice - ($request["kit"][$i]["price"] * $request["kit"][$i]["quantity"]);

        $totalPrice = $totalPrice - $request->discount;
        // Save the Outgoing Invoice
        $invice = ReturnedOutgoingInvoice::create([
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_id,
            'discount' => $request->discount,
            'date' => Carbon::parse($request->date),
            'people_id' => $request->people_id,
            'warehouse_id' => $request->warehouse_id,
            'total' => $totalPrice,
            'user_id' => Auth::id()
        ]);

        if ($request->pay_type) {
            $cash = Cash::find($request->cash_type);
            $cash->available = $cash->available -  $totalPrice;
            $cash->save();
        } else {
            $people = People::find($request->people_id);
            $people->balance = $people->balance +  $totalPrice;
            $people->save();
        }


        // Save The Content Of Outgoing Invoice
        if (!is_null($request["content"])) {
            for ($i = 0; $i <  count($request["content"]); $i++) {
                ReturnedOutgoingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'returned_outgoing_invoice_id' => $invice['id'],
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $product = Product::find($request["content"][$i]["product_id"]);
                $product->stock = $product->stock + $request["content"][$i]["quantity"];
                $product->save();
            }
        }

        // Save The Kit Of Outgoing Invoice
        if (!is_null($request["kit"])) {
            for ($i = 0; $i <  count($request["kit"]); $i++) {
                ReturnedOutgoingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'returned_outgoing_invoice_id' => $invice['id'],
                    'people_id' => $request->people_id,
                    'user_id' => Auth::id(),
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $kit = Kit::find($request["kit"][$i]["kit_id"]);
                $kit->stock = $kit->stock + $request["kit"][$i]["quantity"];
                $kit->save();
            }
        }

        return redirect()->route('returned-outgoing-invoice.show', $invice['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnedOutgoingInvoice $returnedOutgoingInvoice)
    {
        return Inertia::render('ReturnedOutgoingInvoice/Show', [
            "ReturnedOutgoingInvoice" => ReturnedOutgoingInvoice::where('id', $returnedOutgoingInvoice->id)->with('user', 'people', 'warehouse', 'cash')->get(),

            "returnedOutgoingInvoiceContent" => ReturnedOutgoingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('returned_outgoing_invoice_id',  $returnedOutgoingInvoice->id)->get(),

            "returnedOutgoingInvoiceKit" => ReturnedOutgoingInvoiceKit::with(
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
            )->where('returned_outgoing_invoice_id',  $returnedOutgoingInvoice->id)->get(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit($returnedOutgoingInvoice)
    {
        return Inertia::render('ReturnedOutgoingInvoice/Create', [
            "returnedOutgoingInvoice" => ReturnedOutgoingInvoice::where('id', $returnedOutgoingInvoice->id)->get(),
            "returnedOutgoingInvoiceContent" => ReturnedOutgoingInvoiceContent::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->get(),
            "returnedOutgoingInvoiceKit" => ReturnedOutgoingInvoiceKit::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
            "suppliers" => People::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReturnedOutgoingInvoiceRequest  $request
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReturnedOutgoingInvoiceRequest $request, $returnedOutgoingInvoice)
    {
        $totalPrice = 0;
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++)
                $totalPrice = $totalPrice - ($request["content"][$i]["price"] * $request["content"][$i]["quantity"]);
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++)
                $totalPrice = $totalPrice - ($request["kit"][$i]["price"] * $request["kit"][$i]["quantity"]);

        // Undo The Blance of invoice
        if ($returnedOutgoingInvoice->pay_type) {
            $cash = Cash::find($returnedOutgoingInvoice->cash_type);
            $cash->available = $cash->available +  $returnedOutgoingInvoice->total;
            $cash->save();
        } else {
            $people = People::find($returnedOutgoingInvoice->people_id);
            $people->balance = $people->balance -  $returnedOutgoingInvoice->total;
            $people->save();
        }

        $oldContent = ReturnedOutgoingInvoiceContent::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->get();
        for ($i = 0; $i <  count($oldContent); $i++) {
            $product = Product::find($oldContent[$i]["product_id"]);
            $product->stock = $product->stock - $oldContent[$i]["quantity"];
            $product->save();
        }

        $oldKit = ReturnedOutgoingInvoiceKit::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->get();
        for ($i = 0; $i <  count($oldKit); $i++) {
            $kit = Kit::find($oldKit[$i]["kit_id"]);
            $kit->stock = $kit->stock - $oldKit[$i]["quantity"];
            $kit->save();
        }


        $totalPrice = $totalPrice + $request->discount;
        // Make The Blance Agane
        if ($request->pay_type) {
            $cash = Cash::find($request->cash_type);
            $cash->available = $cash->available +  $totalPrice;
            $cash->save();
        } else {
            $people = People::find($request->people_id);
            $people->balance = $people->balance -  $totalPrice;
            $people->save();
        }

        $returnedOutgoingInvoice->pay_type = $request->pay_type;
        $returnedOutgoingInvoice->cash_id = $request->cash_id;
        $returnedOutgoingInvoice->discount = $request->discount;
        $returnedOutgoingInvoice->date = $request->date;
        $returnedOutgoingInvoice->total = $totalPrice;
        $returnedOutgoingInvoice->people_id = $request->people_id;
        $returnedOutgoingInvoice->warehouse_id = $request->warehouse_id;
        $returnedOutgoingInvoice->save();
        ReturnedOutgoingInvoiceContent::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->delete();
        ReturnedOutgoingInvoiceKit::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->delete();

        // Save The Content Of Outgoing Invoice
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++) {
                ReturnedOutgoingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'returned_outgoing_invoice_id' => $returnedOutgoingInvoice['id'],
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $product = Product::find($request["content"][$i]["product_id"]);
                $product->stock = $product->stock + $request["content"][$i]["quantity"];
                $product->save();
            }


        // Save The Kit Of Outgoing Invoice
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++) {
                ReturnedOutgoingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'returned_outgoing_invoice_id' => $returnedOutgoingInvoice['id'],
                    'people_id' => $request->people_id,
                    'user_id' => Auth::id(),
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $kit = Kit::find($request["kit"][$i]["kit_id"]);
                $kit->stock = $kit->stock + $request["kit"][$i]["quantity"];
                $kit->save();
            }

        return redirect()->route('returned-outgoing-invoice.show', $returnedOutgoingInvoice['id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnedOutgoingInvoice  $returnedOutgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnedOutgoingInvoice $returnedOutgoingInvoice)
    {
        // Undo The Blance of invoice
        if ($returnedOutgoingInvoice->pay_type) {
            $cash = Cash::find($returnedOutgoingInvoice->cash_type);
            $cash->available = $cash->available -  $returnedOutgoingInvoice->total;
            $cash->save();
        } else {
            $people = People::find($returnedOutgoingInvoice->people_id);
            $people->balance = $people->balance +  $returnedOutgoingInvoice->total;
            $people->save();
        }

        $oldContent =ReturnedOutgoingInvoiceContent::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->get();
        for ($i = 0; $i <  count($oldContent); $i++) {
            $product = Product::find($oldContent[$i]["product_id"]);
            $product->stock = $product->stock + $oldContent[$i]["quantity"];
            $product->save();
        }

        $oldKit = ReturnedOutgoingInvoiceKit::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->get();
        for ($i = 0; $i <  count($oldKit); $i++) {
            $kit = Kit::find($oldKit[$i]["kit_id"]);
            $kit->stock = $kit->stock + $oldKit[$i]["quantity"];
            $kit->save();
        }

        ReturnedOutgoingInvoiceContent::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->delete();
        ReturnedOutgoingInvoiceKit::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->delete();
        ReturnedOutgoingInvoiceNote::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->delete();

        $images  = ReturnedOutgoingInvoiceImage::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->get();
        for ($i = 0; $i <  count($images); $i++) {
            Storage::delete("public/" . $images[$i]["image"]);
        }
        ReturnedOutgoingInvoiceImage::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->delete();

        $attachment  = ReturnedOutgoingInvoiceAttachment::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->get();
        for ($i = 0; $i <  count($images); $i++) {
            Storage::delete("public/" . $attachment[$i]["attachment"]);
        }
        ReturnedOutgoingInvoiceImage::where('returned_outgoing_invoice_id', $returnedOutgoingInvoice->id)->delete();

        $returnedOutgoingInvoice->delete();

        return Redirect::route('returned-outgoing-invoice.index');
    }
}
