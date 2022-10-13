<?php

namespace App\Http\Controllers\OutgoingInvoice;

use App\Http\Controllers\Controller;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Http\Requests\OutgoingInvoice\StoreOutgoingInvoiceRequest;
use App\Http\Requests\OutgoingInvoice\UpdateOutgoingInvoiceRequest;
use Illuminate\Support\Facades\Request;
use App\Models\Cash\Cash;
use App\Models\OutgoingInvoice\OutgoingInvoiceAttachment;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\People\People;
use App\Models\Product\Product;
use App\Models\OutgoingInvoice\ReturnedOutgoingInvoice;
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
        return Inertia::render('OutgoingInvoice/CreateOutgoingInvoice', [
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
            "customers" => People::orderBy("type")->get()
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
        // Save the Incoming Invoice
        $invice = OutgoingInvoice::create([
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_type,
            'discount' => $request->discount,
            'date' => $request->date,
            'people_id' => $request->customer,
            'warehouse_id' => $request->warehouses,
            'user_id' => Auth::id()
        ]);

        // Save Attachment Of Incoming Invoice
        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/outgoingInvoice', 'public');
                OutgoingInvoiceAttachment::create([
                    'attachment' =>  $attachment_path,
                    'outgoing_invoice_id' => $invice['id'],
                    'user_id' => Auth::id()
                ]);
            }
        }

        // Save The Content Of Incoming Invoice
        for ($i = 0; $i <  count($request["content"]); $i++) {
            OutgoingInvoiceContent::create([
                'product_id' => $request["content"][$i]["product"],
                'price' => $request["content"][$i]["price"],
                'quantity' => $request["content"][$i]["quantity"],
                'outgoing_invoice_id' => $invice['id'],
                'user_id' => Auth::id()
            ]);
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OutgoingInvoice  $outgoingInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($outgoingInvoice)
    {
        return Inertia::render('OutgoingInvoice/ShowOutgoingInvoice', [
            "outgoingInvoice" => OutgoingInvoice::where('id', $outgoingInvoice)->with('user', 'people', 'warehouse', 'cash')->get(),
            "outgoingInvoiceContent" => OutgoingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('outgoing_invoice_id', $outgoingInvoice)->get(),
            "outgoingInvoiceAttachment" => OutgoingInvoiceAttachment::where('outgoing_invoice_id', $outgoingInvoice)->get(),
            "returnedOutgoingInvoice" => ReturnedOutgoingInvoice::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('outgoing_invoice_id', $outgoingInvoice)->get(),
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
        return Inertia::render('OutgoingInvoice/EditOutgoingInvoice', [
            "outgoingInvoice" => OutgoingInvoice::where('id', $outgoingInvoice)->with('user', 'people', 'warehouse', 'cash')->get(),
            "outgoingInvoiceContent" => OutgoingInvoiceContent::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('outgoing_invoice_id', $outgoingInvoice)->get(),
            "outgoingInvoiceAttachment" => OutgoingInvoiceAttachment::where('outgoing_invoice_id', $outgoingInvoice)->get(),
            "returnedOutgoingInvoice" => ReturnedOutgoingInvoice::with('product', 'product.product_country', 'product.product_material', 'product.product_color', 'product.product_model', 'product.product_collection', 'product.product_brand', 'product.product_type', 'product.product_category')->where('outgoing_invoice_id', $outgoingInvoice)->get(),
            "products" => Product::with('product_country', 'product_material', 'product_color', 'product_model', 'product_collection', 'product_brand', 'product_type', 'product_category')->get(),
            "cash" => Cash::all(),
            "warehouses" => Warehouse::all(),
            "people" => People::orderByDesc("type")->get()
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
        // Edit the Outgoing Invoice
        $invice = DB::table('outgoing_invoices')->where('id', $outgoingInvoice->id)->update([
            'pay_type' => $request->pay_type,
            'cash_id' => $request->cash_type,
            'discount' => $request->discount,
            'date' => $request->date,
            'people_id' => $request->people,
            'warehouse_id' => $request->warehouses,
        ]);

        // Save New Attachment Of Incoming Invoice

        //Delete The old items removed

        if (is_array($request["oldAttachment"])) {

            $oldAttachmentId = [];
            for ($i = 0; $i <  count($request["oldAttachment"]); $i++) {
                $oldAttachmentId[] = $request["oldAttachment"][$i]["id"];
            }
            $item = OutgoingInvoiceAttachment::whereNotIn('id', $oldAttachmentId)->where('outgoing_invoice_id', $outgoingInvoice->id)->get();
            for ($i = 0; $i <  count($item); $i++) {
                Storage::delete("public/" . $item[$i]["attachment"]);
                $item[$i]->delete();
            }
        }

        for ($i = 0; $i <  count($request["attachment"]); $i++) {
            if ($request["attachment"][$i]["attachment"] != null) {
                $attachment_path = $request["attachment"][$i]["attachment"]->store('attachment/outgoingInvoice', 'public');
                OutgoingInvoiceAttachment::create([
                    'attachment' =>  $attachment_path,
                    'outgoing_invoice_id' => $outgoingInvoice->id,
                    'user_id' => Auth::id()
                ]);
            } else {
                OutgoingInvoiceAttachment::create([
                    'attachment' =>  $attachment_path,
                    'outgoing_invoice_id' => $outgoingInvoice->id,
                    'user_id' => Auth::id()
                ]);
            }
        }

        // Save The Content Of Incoming Invoice.

        OutgoingInvoiceContent::where('outgoing_invoice_id', $outgoingInvoice->id)->delete();
        for ($i = 0; $i <  count($request["content"]); $i++) {
            OutgoingInvoiceContent::create([
                'product_id' => $request["content"][$i]["product_id"],
                'price' => $request["content"][$i]["price"],
                'quantity' => $request["content"][$i]["quantity"],
                'outgoing_invoice_id' => $outgoingInvoice->id,
                'user_id' => Auth::id()
            ]);
        }

        return Redirect::back();
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
