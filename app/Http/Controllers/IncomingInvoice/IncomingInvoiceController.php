<?php

namespace App\Http\Controllers\IncomingInvoice;

use App\Http\Controllers\Controller;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Http\Requests\IncomingInvoice\StoreIncomingInvoiceRequest;
use App\Http\Requests\IncomingInvoice\UpdateIncomingInvoiceRequest;
use App\Models\Cash\Cash;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\Kit\Kit;
use App\Models\People\People;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Request;
use App\Models\IncomingInvoice\ReturnedIncomingInvoice;
use App\Models\IncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\Warehouse\Warehouse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IncomingInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('IncomingInvoice/Index', [
            "incomingInvoice" => IncomingInvoice::with('user', 'people', 'warehouse')->orderBy('date', 'desc')->latest()->when(
                Request::input('search'),
                function ($query, $search) {
                    $query->where('number', 'like', "%{$search}%")
                        ->orWhere('date', 'like', "%{$search}%")
                        ->orWhereRelation('warehouse', 'name', 'like', "%{$search}%")
                        ->orWhereRelation('people', 'name', 'like', "%{$search}%");
                }
            )->paginate(35)->withQueryString(),

            'filters' => Request::only(['search']),
            'totalIncomingInvoice' => IncomingInvoice::count(),
            'totalIncomingInvoiceThisDay' => IncomingInvoice::where('date', '>=', Carbon::now()->locale('eg')->toDateString())->count(),
            'totalIncomingInvoiceThisWeek' => IncomingInvoice::where('date', '>=', Carbon::now()->startOfWeek()->subWeek()->toDateString())->count(),
            'totalIncomingInvoiceThisMonth' => IncomingInvoice::where('date', '>=', Carbon::now()->startOfMonth()->subMonth()->toDateString())->count(),
            'totalIncomingInvoiceThisYear' => IncomingInvoice::where('date', '>=', Carbon::now()->startOfYear()->subMonth()->toDateString())->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('IncomingInvoice/Create', [
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncomingInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomingInvoiceRequest $request)
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
        $invice = IncomingInvoice::create([
            'number' => $request->number,
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
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++) {
                IncomingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'incoming_invoice_id' => $invice['id'],
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $product = Product::find($request["content"][$i]["product_id"]);
                $product->stock = $product->stock + $request["content"][$i]["quantity"];
                $product->save();
            }

        // Save The Kit Of Incoming Invoice
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++) {
                IncomingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'incoming_invoice_id' => $invice['id'],
                    'people_id' => $request->people_id,
                    'user_id' => Auth::id(),
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $kit = Kit::find($request["kit"][$i]["kit_id"]);
                $kit->stock = $kit->stock + $request["kit"][$i]["quantity"];
                $kit->save();
            }

        return redirect()->route('incoming-invoice.show', $invice['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($incomingInvoice)
    {
        return Inertia::render('IncomingInvoice/Show', [
            "incomingInvoice" => IncomingInvoice::where('id', $incomingInvoice)->with('user', 'people', 'warehouse', 'cash')->get(),
            "incomingInvoiceContent" => IncomingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('incoming_invoice_id', $incomingInvoice)->get(),
            "incomingInvoiceKit" => IncomingInvoiceKit::with(
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
            )->where('incoming_invoice_id', $incomingInvoice)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit($incomingInvoice)
    {
        return Inertia::render('IncomingInvoice/Create', [
            "invoice" => IncomingInvoice::where('id', $incomingInvoice)->get(),
            "invoiceContent" => IncomingInvoiceContent::where('incoming_invoice_id', $incomingInvoice)->get(),
            "invoiceKit" => IncomingInvoiceKit::where('incoming_invoice_id', $incomingInvoice)->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
            "suppliers" => People::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomingInvoiceRequest  $request
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomingInvoiceRequest $request, IncomingInvoice $incomingInvoice)
    {
        $totalPrice = 0;
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++)
                $totalPrice = $totalPrice + ($request["content"][$i]["price"] * $request["content"][$i]["quantity"]);
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++)
                $totalPrice = $totalPrice + ($request["kit"][$i]["price"] * $request["kit"][$i]["quantity"]);

        // Undo The Blance of invoice
        if ($incomingInvoice->cash_id) {
            $cash = Cash::find($incomingInvoice->cash_type);
            $cash->available = $cash->available +  $incomingInvoice->total;
            $cash->save();
        } else {
            $people = People::find($incomingInvoice->people_id);
            $people->balance = $people->balance -  $incomingInvoice->total;
            $people->save();
        }

        $oldContent = IncomingInvoiceContent::where('incoming_invoice_id', $incomingInvoice->id)->get();
        for ($i = 0; $i <  count($oldContent); $i++) {
            $product = Product::find($oldContent[$i]["product_id"]);
            $product->stock = $product->stock - $oldContent[$i]["quantity"];
            $product->save();
        }

        $oldKit = IncomingInvoiceKit::where('incoming_invoice_id', $incomingInvoice->id)->get();
        for ($i = 0; $i <  count($oldKit); $i++) {
            $kit = Kit::find($oldKit[$i]["kit_id"]);
            $kit->stock = $kit->stock - $oldKit[$i]["quantity"];
            $kit->save();
        }


        $totalPrice = $totalPrice - $request->discount;
        // Make The Blance Agane
        if ($request->cash_id) {
            $cash = Cash::find($request->cash_id);
            $cash->available = $cash->available -  $totalPrice;
            $cash->save();
        } else {
            $people = People::find($request->people_id);
            $people->balance = $people->balance +  $totalPrice;
            $people->save();
        }


        $incomingInvoice->number = $request->number;
        $incomingInvoice->pay_type = $request->pay_type;
        $incomingInvoice->cash_id = $request->cash_id;
        $incomingInvoice->discount = $request->discount;
        $incomingInvoice->date = $request->date;
        $incomingInvoice->total = $totalPrice;
        $incomingInvoice->people_id = $request->people_id;
        $incomingInvoice->warehouse_id = $request->warehouse_id;
        $incomingInvoice->save();
        IncomingInvoiceContent::where('incoming_invoice_id', $incomingInvoice->id)->delete();
        IncomingInvoiceKit::where('incoming_invoice_id', $incomingInvoice->id)->delete();

        // Save The Content Of Incoming Invoice
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++) {
                IncomingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product_id"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'incoming_invoice_id' => $incomingInvoice['id'],
                    'user_id' => Auth::id(),
                    'people_id' => $request->people_id,
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $product = Product::find($request["content"][$i]["product_id"]);
                $product->stock = $product->stock + $request["content"][$i]["quantity"];
                $product->save();
            }


        // Save The Kit Of Incoming Invoice
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++) {
                IncomingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit_id"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'incoming_invoice_id' => $incomingInvoice['id'],
                    'people_id' => $request->people_id,
                    'user_id' => Auth::id(),
                    'warehouse_id' => $request->warehouse_id,
                    'date' => Carbon::parse($request->date),
                ]);
                $kit = Kit::find($request["kit"][$i]["kit_id"]);
                $kit->stock = $kit->stock + $request["kit"][$i]["quantity"];
                $kit->save();
            }

        return redirect()->route('incoming-invoice.show', $incomingInvoice['id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(IncomingInvoice $incomingInvoice)
    {
        //
    }
}
