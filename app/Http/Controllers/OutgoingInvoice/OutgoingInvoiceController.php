<?php

namespace App\Http\Controllers\OutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Http\Requests\OutgoingInvoice\StoreOutgoingInvoiceRequest;
use App\Http\Requests\OutgoingInvoice\UpdateOutgoingInvoiceRequest;
use Illuminate\Support\Facades\Request;
use App\Models\Cash\Cash;
use App\Models\Kit\Kit;
use App\Models\OutgoingInvoice\OutgoingInvoiceAttachment;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\People\People;
use App\Models\Product\Product;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\Warehouse\Warehouse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class OutgoingInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('OutgoingInvoice/Index', [
            "outgoingInvoice" => OutgoingInvoice::with('user', 'people', 'warehouse')->orderBy('date', 'desc')->latest()->when(
                Request::input('search'),
                function ($query, $search) {
                    $query->where('number', 'like', "%{$search}%")
                        ->orWhere('date', 'like', "%{$search}%")
                        ->orWhereRelation('warehouse', 'name', 'like', "%{$search}%")
                        ->orWhereRelation('people', 'name', 'like', "%{$search}%");
                }
            )->paginate(35)->withQueryString(),

            'filters' => Request::only(['search']),
            'totalOutgoingInvoice' => OutgoingInvoice::count(),
            'totalOutgoingInvoiceThisDay' => OutgoingInvoice::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->count(),
            'totalOutgoingInvoiceThisWeek' => OutgoingInvoice::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->count(),
            'totalOutgoingInvoiceThisMonth' => OutgoingInvoice::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->count(),
            'totalOutgoingInvoiceThisYear' => OutgoingInvoice::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('OutgoingInvoice/Create', [
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOutgoingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOutgoingInvoiceRequest $request)
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
        $invice = OutgoingInvoice::create([
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_id,
            'discount' => $request->discount,
            'date' => Carbon::parse($request->date),
            'people_id' => $request->people_id,
            'warehouse_id' => $request->warehouse_id,
            'total' => $totalPrice - $request->discount,
            'user_id' => Auth::id()
        ]);

        if ($request->pay_type) {
            $cash = Cash::find($request->cash_id);
            $cash->available = $cash->available +  $totalPrice;
            $cash->save();
        } else {
            $people = People::find($request->people_id);
            $people->balance = $people->balance -  $totalPrice;
            $people->save();
        }

        // Save The Content Of Incoming Invoice
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++) {
                OutgoingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'outgoing_invoice_id' => $invice['id'],
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
                OutgoingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'outgoing_invoice_id' => $invice['id'],
                    'people_id' => $request->people_id,
                    'user_id' => Auth::id(),
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $kit = Kit::find($request["kit"][$i]["kit_id"]);
                $kit->stock = $kit->stock - $request["kit"][$i]["quantity"];
                $kit->save();
            }

        return redirect()->route('outgoing-invoice.show', $invice['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($outgoingInvoice)
    {
        return Inertia::render('OutgoingInvoice/Show', [
            "outgoingInvoice" => OutgoingInvoice::where('id', $outgoingInvoice)->with('user', 'people', 'warehouse', 'cash')->get(),
            "outgoingInvoiceContent" => OutgoingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('outgoing_invoice_id', $outgoingInvoice)->get(),

            "returnedOutgoingInvoice" => ReturnedOutgoingInvoice::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('outgoing_invoice_id', $outgoingInvoice)->get(),

            "outgoingInvoiceKit" => OutgoingInvoiceKit::with(
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
            )->where('outgoing_invoice_id', $outgoingInvoice)->get(),

            "returnedOutgoingInvoiceKit" => ReturnedOutgoingInvoiceKit::with('kit', 'kit.product', 'kit.product.product_country', 'kit.product.product_material', 'kit.product.product_color', 'kit.product.product_model', 'kit.product.product_collection', 'kit.product.product_brand', 'kit.product.product_type', 'kit.product.product_category')->where('outgoing_invoice_id', $outgoingInvoice)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit($outgoingInvoice)
    {

        return Inertia::render('OutgoingInvoice/Create', [
            "invoice" => OutgoingInvoice::where('id', $outgoingInvoice)->get(),
            "invoiceContent" => OutgoingInvoiceContent::where('outgoing_invoice_id', $outgoingInvoice)->get(),
            "invoiceKit" => OutgoingInvoiceKit::where('outgoing_invoice_id', $outgoingInvoice)->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOutgoingInvoiceRequest  $request
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOutgoingInvoiceRequest $request, OutgoingInvoice $outgoingInvoice)
    {
        $totalPrice = 0;
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++)
                $totalPrice = $totalPrice + ($request["content"][$i]["price"] * $request["content"][$i]["quantity"]);
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++)
                $totalPrice = $totalPrice + ($request["kit"][$i]["price"] * $request["kit"][$i]["quantity"]);


        if ($outgoingInvoice->pay_type) {
            $cash = Cash::find($outgoingInvoice->cash_type);
            $cash->available = $cash->available -  $outgoingInvoice->total;
            $cash->save();
        } else {
            $people = People::find($outgoingInvoice->people_id);
            $people->balance = $people->balance +  $outgoingInvoice->total;
            $people->save();
        }

        $totalPrice = $totalPrice - $request->discount;

        // Make The Blance Agane
        if ($request->pay_type) {
            $cash = Cash::find($request->cash_id);
            $cash->available = $cash->available +  $totalPrice;
            $cash->save();
        } else {
            $people = People::find($request->people_id);
            $people->balance = $people->balance -  $totalPrice;
            $people->save();
        }

        $oldContent = OutgoingInvoiceContent::where('outgoing_invoice_id', $outgoingInvoice->id)->get();
        for ($i = 0; $i <  count($oldContent); $i++) {
            $product = Product::find($oldContent[$i]["product_id"]);
            $product->stock = $product->stock - $oldContent[$i]["quantity"];
            $product->save();
        }

        $oldKit = OutgoingInvoiceKit::where('outgoing_invoice_id', $outgoingInvoice->id)->get();
        for ($i = 0; $i <  count($oldKit); $i++) {
            $kit = Kit::find($oldKit[$i]["kit_id"]);
            $kit->stock = $kit->stock - $oldKit[$i]["quantity"];
            $kit->save();
        }


        $outgoingInvoice->pay_type = $request->pay_type;
        $outgoingInvoice->cash_id = $request->cash_id;
        $outgoingInvoice->discount = $request->discount;
        $outgoingInvoice->date = $request->date;
        $outgoingInvoice->total = $totalPrice - $request->discount;
        $outgoingInvoice->people_id = $request->people_id;
        $outgoingInvoice->warehouse_id = $request->warehouse_id;
        $outgoingInvoice->save();
        OutgoingInvoiceContent::where('outgoing_invoice_id', $outgoingInvoice->id)->delete();
        OutgoingInvoiceKit::where('outgoing_invoice_id', $outgoingInvoice->id)->delete();

        // Save The Content Of Incoming Invoice
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++) {
                OutgoingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'outgoing_invoice_id' => $outgoingInvoice['id'],
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
                OutgoingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'outgoing_invoice_id' => $outgoingInvoice['id'],
                    'people_id' => $request->people_id,
                    'user_id' => Auth::id(),
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $kit = Kit::find($request["kit"][$i]["kit_id"]);
                $kit->stock = $kit->stock - $request["kit"][$i]["quantity"];
                $kit->save();
            }

        return redirect()->route('outgoing-invoice.show', $outgoingInvoice['id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(OutgoingInvoice $outgoingInvoice)
    {
        //
    }
}
