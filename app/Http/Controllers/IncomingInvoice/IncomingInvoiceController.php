<?php

namespace App\Http\Controllers\IncomingInvoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomingInvoice\StoreIncomingInvoiceContentRequest;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Http\Requests\IncomingInvoice\StoreIncomingInvoiceRequest;
use App\Http\Requests\IncomingInvoice\UpdateIncomingInvoiceRequest;
use App\Models\Cash\Cash;
use App\Models\IncomingInvoice\IncomingInvoiceAttachment;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
            "suppliers" => People::orderByDesc("type")->get(),
            "kits" => Kit::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->get(),
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

        // Save the Incoming Invoice
        $invice = IncomingInvoice::create([
            'number' => $request->number,
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_type,
            'discount' => $request->discount,
            'date' => $request->date,
            'people_id' => $request->supplier,
            'warehouse_id' => $request->warehouses,
            'user_id' => Auth::id()
        ]);

        // Save Attachment Of Incoming Invoice
        if (!is_null($request["attachment"]))
            for ($i = 0; $i <  count($request["attachment"]); $i++) {
                if ($request["attachment"][$i]["attachment"] != null) {
                    $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/incomingInvoice', 'public');
                    IncomingInvoiceAttachment::create([
                        'attachment' =>  $attachment_path,
                        'incoming_invoice_id' => $invice['id'],
                        'user_id' => Auth::id()
                    ]);
                }
            }


        // Save The Content Of Incoming Invoice
        if (!is_null($request["content"]))
            for ($i = 0; $i <  count($request["content"]); $i++) {
                IncomingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'incoming_invoice_id' => $invice['id'],
                    'user_id' => Auth::id()
                ]);
            }


        // Save The Kit Of Incoming Invoice
        if (!is_null($request["kit"]))
            for ($i = 0; $i <  count($request["kit"]); $i++) {
                IncomingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'incoming_invoice_id' => $invice['id'],
                    'user_id' => Auth::id()
                ]);
            }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($incomingInvoice)
    {
        // return Inertia::render('IncomingInvoice/ShowIncomingInvoice', [
        //     "incomingInvoice" => IncomingInvoice::where('id', $incomingInvoice)->with('user', 'people', 'warehouse', 'cash')->get(),
        //     "incomingInvoiceContent" => IncomingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('incoming_invoice_id', $incomingInvoice)->get(),
        //     "incomingInvoiceAttachment" => IncomingInvoiceAttachment::where('incoming_invoice_id', $incomingInvoice)->get(),
        //     "returnedIncomingInvoice" => ReturnedIncomingInvoice::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('incoming_invoice_id', $incomingInvoice)->where('quantity', ">", 0)->get(),
        //     "incomingInvoiceKit" => IncomingInvoiceKit::with('kit', 'kit.product', 'kit.product.product_country', 'kit.product.product_material', 'kit.product.product_color', 'kit.product.product_model', 'kit.product.product_collection', 'kit.product.product_brand', 'kit.product.product_type', 'kit.product.product_category')->where('incoming_invoice_id', $incomingInvoice)->get(),
        //     "returnedIncomingInvoiceKit" => ReturnedIncomingInvoiceKit::with('kit', 'kit.product', 'kit.product.product_country', 'kit.product.product_material', 'kit.product.product_color', 'kit.product.product_model', 'kit.product.product_collection', 'kit.product.product_brand', 'kit.product.product_type', 'kit.product.product_category')->where('incoming_invoice_id', $incomingInvoice)->get(),
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IncomingInvoice  $incomingInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit($incomingInvoice)
    {

        // return Inertia::render('IncomingInvoice/EditIncomingInvoice', [
        //     "incomingInvoice" => IncomingInvoice::where('id', $incomingInvoice)->with('user', 'people', 'warehouse', 'cash')->get(),
        //     "incomingInvoiceContent" => IncomingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('incoming_invoice_id', $incomingInvoice)->get(),
        //     "incomingInvoiceAttachment" => IncomingInvoiceAttachment::where('incoming_invoice_id', $incomingInvoice)->get(),
        //     "returnedIncomingInvoice" => ReturnedIncomingInvoice::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('incoming_invoice_id', $incomingInvoice)->get(),
        //     "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
        //     "cash" => Cash::all(),
        //     "warehouses" => Warehouse::all(),
        //     "suppliers" => People::orderByDesc("type")->get(),
        //     "kits" => Kit::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->get(),
        //     "incomingInvoiceKit" => IncomingInvoiceKit::with('kit', 'kit.product', 'kit.product.product_country', 'kit.product.product_material', 'kit.product.product_color', 'kit.product.product_model', 'kit.product.product_collection', 'kit.product.product_brand', 'kit.product.product_type', 'kit.product.product_category')->where('incoming_invoice_id', $incomingInvoice)->get(),
        // ]);
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
        /*
        // Edit the Incoming Invoice
        $invice = DB::table('incoming_invoices')->where('id', $incomingInvoice->id)->update([
            'number' => $request->number,
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_type,
            'discount' => $request->discount,
            'date' => $request->date,
            'people_id' => $request->supplier,
            'warehouse_id' => $request->warehouses,
        ]);

        // Save New Attachment Of Incoming Invoice

        //Delete The old items removed

        if (is_array($request["oldAttachment"])) {

            $oldAttachmentId = [];
            for ($i = 0; $i <  count($request["oldAttachment"]); $i++) {
                $oldAttachmentId[] = $request["oldAttachment"][$i]["id"];
            }
            $item = IncomingInvoiceAttachment::whereNotIn('id', $oldAttachmentId)->where('incoming_invoice_id', $incomingInvoice->id)->get();
            for ($i = 0; $i <  count($item); $i++) {
                Storage::delete("public/" . $item[$i]["attachment"]);
                $item[$i]->delete();
            }
        }

        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/incomingInvoice', 'public');
                IncomingInvoiceAttachment::create([
                    'attachment' =>  $attachment_path,
                    'incoming_invoice_id' => $incomingInvoice->id,
                    'user_id' => Auth::id()
                ]);
            } else {
                IncomingInvoiceAttachment::create([
                    'attachment' =>  $attachment_path,
                    'incoming_invoice_id' => $incomingInvoice->id,
                    'user_id' => Auth::id()
                ]);
            }
        }

        // Save The Content Of Incoming Invoice.
        IncomingInvoiceContent::where('incoming_invoice_id', $incomingInvoice->id)->delete(); // Delete Data

        for ($i = 0; $i <  count($request["content"]); $i++) {
            if ($request["content"][$i]["quantity"] > 0)
                IncomingInvoiceContent::create([
                    'product_id' => $request["content"][$i]["product"],
                    'price' => $request["content"][$i]["price"],
                    'quantity' => $request["content"][$i]["quantity"],
                    'incoming_invoice_id' => $incomingInvoice->id,
                    'user_id' => Auth::id()
                ]);
        }
        
        for ($i = 0; $i <  count($request["oldContent"]); $i++) {
            if ($request["oldContent"][$i]["quantity"] > 0)
                IncomingInvoiceContent::create([
                    'product_id' => $request["oldContent"][$i]["product_id"],
                    'price' => $request["oldContent"][$i]["price"],
                    'quantity' => $request["oldContent"][$i]["quantity"],
                    'incoming_invoice_id' => $incomingInvoice->id,
                    'user_id' => Auth::id()
                ]);
        }
        
        // Save The Kit Of Incoming Invoice.
        IncomingInvoiceKit::where('incoming_invoice_id', $incomingInvoice->id)->delete();
        for ($i = 0; $i <  count($request["kit"]); $i++) {
            if ($request["kit"][$i]["quantity"] > 0)
                IncomingInvoiceKit::create([
                    'kit_id' => $request["kit"][$i]["kit"],
                    'quantity' => $request["kit"][$i]["quantity"],
                    'price' => $request["kit"][$i]["price"],
                    'incoming_invoice_id' => $incomingInvoice->id,
                    'user_id' => Auth::id()
                ]);
        }
        for ($i = 0; $i <  count($request["oldKit"]); $i++) {
            if ($request["oldKit"][$i]["quantity"] > 0)
                IncomingInvoiceKit::create([
                    'kit_id' => $request["oldKit"][$i]["kit_id"],
                    'quantity' => $request["oldKit"][$i]["quantity"],
                    'price' => $request["oldKit"][$i]["price"],
                    'incoming_invoice_id' => $incomingInvoice->id,
                    'user_id' => Auth::id()
                ]);
        }

        return Redirect::back();*/
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
