<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\Controller;
use App\Http\Requests\People\StorePeopleRequest;
use App\Http\Requests\People\UpdatePeopleRequest;
use App\Models\Creditor\Creditor;
use App\Models\Creditor\CreditorPay;
use App\Models\Debtor\Debtor;
use App\Models\Debtor\DebtorPay;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\IncomingInvoice\IncomingInvoiceContent;
use App\Models\IncomingInvoice\IncomingInvoiceKit;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoice;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceKit;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoiceContent;
use App\Models\OutgoingInvoice\OutgoingInvoiceKit;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoice;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceKit;
use App\Models\People\People;
use App\Models\ReturnedIncomingInvoice\ReturnedIncomingInvoiceContent;
use App\Models\ReturnedOutgoingInvoice\ReturnedOutgoingInvoiceContent;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('People/Index', [
            "people" => People::query()->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->with('user')->paginate(40)->withQueryString(),
            'peopleCount' => People::count(),
            'peopleCreditor' => People::where("balance", ">", 0)->count(),
            'filters' => Request::only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('People/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePeopleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeopleRequest $request)
    {
        $people = People::create(
            [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'logo' => $request->logo,
                'user_id' => auth()->user()->id,
                'logo' => $request->hasFile('logo') ? $request->file('logo')->store('image/people', 'public') : 'no_image.png'
            ]
        );
        return Redirect::route('people.show', $people->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show($people)
    {
        return Inertia::render('People/Show', [
            "people" => People::where('id', $people)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit($people)
    {
        return Inertia::render('People/Create', [
            "people" => People::where('id', $people)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePeopleRequest  $request
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleRequest $request, $people)
    {
        $People = People::find($people);
        $People->name = $request->name;
        $People->address = $request->address;
        $People->phone = $request->phone;
        if ($request->hasFile('logo')) {
            if ($request->old_image == "no_image.png")
                Storage::delete("public/" . $request->old_image);
            $People->logo = $request->file('logo')->store('image/people', 'public');
        }
        $People->save();
        return Redirect::route('people.show', $People->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }

    public function data()
    {
        if (Request::input('id')) {
            return People::where('id', Request::input('id'))->get();
        }
        return People::query()->when(Request::input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        })->paginate(10)->withQueryString();
    }

    public function action()
    {
        $people = Request::input('people');
        $action = Request::input('action');

        // Get Actions
        $actionData = collect([]);

        if ($action == "IncomingInvoice" || $action == null) {
            $IncomingInvoiceContent = IncomingInvoice::with('user', 'people', 'warehouse', 'cash')->where('people_id', $people)->get();
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "IncomingInvoice";
                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }

        if ($action == "ReturnedIncomingInvoice" || $action == null) {
            $IncomingInvoiceContent = ReturnedIncomingInvoice::with('user', 'people', 'warehouse', 'cash')->where('people_id', $people)->get();
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }

        if ($action == "ReturnedOutgoingInvoice" || $action == null) {
            $IncomingInvoiceContent = ReturnedOutgoingInvoice::with('user', 'people', 'warehouse', 'cash')->where('people_id', $people)->get();
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "ReturnedOutgoingInvoice";
                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }


        if ($action == "OutgoingInvoice" || $action == null) {
            $OutgoingInvoiceContent = OutgoingInvoice::with('user', 'people', 'warehouse', 'cash')->where('people_id', $people)->get();
            foreach ($OutgoingInvoiceContent as $key => $value) {
                $OutgoingInvoiceContent[$key]["dataType"] = "OutgoingInvoice";
                $actionData->push($OutgoingInvoiceContent[$key]);
            }
        }
        if ($action == "Debtor" || $action == null) {
            $Debtor = Debtor::with('user', 'people')->where('people_id', $people)->get();
            foreach ($Debtor as $key => $value) {
                $Debtor[$key]["dataType"] = "Debtor";
                $actionData->push($Debtor[$key]);
            }
        }
        if ($action == "DebtorPay" || $action == null) {
            $DebtorPay = DebtorPay::with('user', 'people', 'cash')->where('people_id', $people)->where('pay_type', 1)->get();
            foreach ($DebtorPay as $key => $value) {
                $DebtorPay[$key]["dataType"] = "DebtorPay";
                $actionData->push($DebtorPay[$key]);
            }
        }
        if ($action == "DebtorKilled" || $action == null) {
            $DebtorPay = DebtorPay::with('user', 'people', 'cash')->where('people_id', $people)->where('pay_type', 0)->get();
            foreach ($DebtorPay as $key => $value) {
                $DebtorPay[$key]["dataType"] = "DebtorKilled";
                $actionData->push($DebtorPay[$key]);
            }
        }
        if ($action == "Creditor" || $action == null) {
            $Creditor = Creditor::with('user', 'people')->where('people_id', $people)->get();
            foreach ($Creditor as $key => $value) {
                $Creditor[$key]["dataType"] = "Creditor";
                $actionData->push($Creditor[$key]);
            }
        }
        if ($action == "CreditorPay" || $action == null) {
            $CreditorPay = CreditorPay::with('user', 'people', 'cash')->where('people_id', $people)->where('pay_type', 1)->get();
            foreach ($CreditorPay as $key => $value) {
                $CreditorPay[$key]["dataType"] = "CreditorPay";
                $actionData->push($CreditorPay[$key]);
            }
        }
        if ($action == "CreditorKilled" || $action == null) {
            $CreditorPay = CreditorPay::with('user', 'people', 'cash')->where('people_id', $people)->where('pay_type', 0)->get();
            foreach ($CreditorPay as $key => $value) {
                $CreditorPay[$key]["dataType"] = "CreditorKilled";
                $actionData->push($CreditorPay[$key]);
            }
        }
        $actionData = $actionData->sortByDesc('date')->paginate();

        return $actionData;
    }
    public function actionDetails()
    {
        $people = Request::input('people');
        $action = Request::input('action');

        // Get Actions
        $actionData = collect([]);

        if ($action == "IncomingInvoice" || $action == null) {
            $IncomingInvoiceContent = IncomingInvoiceContent::with(
                'user',
                'incoming_invoice',
                'people',
                'warehouse',
                'incoming_invoice.cash',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->where('people_id', $people)->get();
            foreach ($IncomingInvoiceContent as $key => $value) {
                $IncomingInvoiceContent[$key]["dataType"] = "IncomingInvoice";
                $IncomingInvoiceContent[$key]["date"] = $IncomingInvoiceContent[$key]["incoming_invoice"]["date"];
                $actionData->push($IncomingInvoiceContent[$key]);
            }
        }

        if ($action == "IncomingInvoiceKit" || $action == null) {
            $IncomingInvoiceKit = IncomingInvoiceKit::with(
                'user',
                'incoming_invoice',
                'people',
                'warehouse',
                'incoming_invoice.cash',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country',
                'kit.product_category',
                'kit.product_type',
                'kit.product_brand',
                'kit.product_collection',
                'kit.product_model',
                'kit.product_color',
                'kit.product_material',
                'kit.product_country'
            )->where('people_id', $people)->get();
            foreach ($IncomingInvoiceKit as $key => $value) {
                $IncomingInvoiceKit[$key]["dataType"] = "IncomingInvoiceKit";
                $actionData->push($IncomingInvoiceKit[$key]);
            }
        }

        if ($action == "ReturnedIncomingInvoice" || $action == null) {
            $ReturnedIncomingInvoice = ReturnedIncomingInvoiceContent::with([
                'user',
                'returned_incoming_invoice',
                'people',
                'warehouse',
                'returned_incoming_invoice.cash',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            ])->where('people_id', $people)->get();
            foreach ($ReturnedIncomingInvoice as $key => $value) {
                $ReturnedIncomingInvoice[$key]["dataType"] = "ReturnedIncomingInvoice";
                $actionData->push($ReturnedIncomingInvoice[$key]);
            }
        }

        if ($action == "ReturnedIncomingInvoiceKit" || $action == null) {
            $ReturnedIncomingInvoiceKit = ReturnedIncomingInvoiceKit::with(
                'user',
                'returned_incoming_invoice',
                'people',
                'warehouse',
                'returned_incoming_invoice.cash',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country',
                'kit.product_category',
                'kit.product_type',
                'kit.product_brand',
                'kit.product_collection',
                'kit.product_model',
                'kit.product_color',
                'kit.product_material',
                'kit.product_country'
            )->where('people_id', $people)->get();
            foreach ($ReturnedIncomingInvoiceKit as $key => $value) {
                $ReturnedIncomingInvoiceKit[$key]["dataType"] = "ReturnedIncomingInvoiceKit";
                $actionData->push($ReturnedIncomingInvoiceKit[$key]);
            }
        }

        if ($action == "OutgoingInvoice" || $action == null) {
            $OutgoingInvoiceContent = OutgoingInvoiceContent::with(
                'user',
                'outgoing_invoice',
                'people',
                'warehouse',
                'outgoing_invoice.cash',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->where('people_id', $people)->where('people_id', $people)->get();
            foreach ($OutgoingInvoiceContent as $key => $value) {
                $OutgoingInvoiceContent[$key]["dataType"] = "OutgoingInvoice";
                $OutgoingInvoiceContent[$key]["date"] = $OutgoingInvoiceContent[$key]["outgoing_invoice"]["date"];
                $actionData->push($OutgoingInvoiceContent[$key]);
            }
        }

        if ($action == "ReturnedOutgoingInvoice" || $action == null) {
            $ReturnedOutgoingInvoice = ReturnedOutgoingInvoiceContent::with(
                'user',
                'returned_outgoing_invoice',
                'people',
                'warehouse',
                'returned_outgoing_invoice.cash',
                'product',
                'product.product_category',
                'product.product_type',
                'product.product_brand',
                'product.product_collection',
                'product.product_model',
                'product.product_color',
                'product.product_material',
                'product.product_country'
            )->where('people_id', $people)->get();
            foreach ($ReturnedOutgoingInvoice as $key => $value) {
                $ReturnedOutgoingInvoice[$key]["dataType"] = "ReturnedOutgoingInvoice";
                $actionData->push($ReturnedOutgoingInvoice[$key]);
            }
        }

        if ($action == "ReturnedOutgoingInvoiceKit" || $action == null) {
            $ReturnedOutgoingInvoiceKit = ReturnedOutgoingInvoiceKit::with(
                'user',
                'returned_outgoing_invoice',
                'people',
                'warehouse',
                'returned_outgoing_invoice.cash',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country',
                'kit.product_category',
                'kit.product_type',
                'kit.product_brand',
                'kit.product_collection',
                'kit.product_model',
                'kit.product_color',
                'kit.product_material',
                'kit.product_country'
            )->where('people_id', $people)->get();
            foreach ($ReturnedOutgoingInvoiceKit as $key => $value) {
                $ReturnedOutgoingInvoiceKit[$key]["dataType"] = "ReturnedOutgoingInvoiceKit";
                $actionData->push($ReturnedOutgoingInvoiceKit[$key]);
            }
        }

        if ($action == "OutgoingInvoiceKit" || $action == null) {
            $OutgoingInvoiceKit = OutgoingInvoiceKit::with(
                'user',
                'outgoing_invoice',
                'people',
                'warehouse',
                'outgoing_invoice.cash',
                'kit',
                'kit.product',
                'kit.product.product_category',
                'kit.product.product_type',
                'kit.product.product_brand',
                'kit.product.product_collection',
                'kit.product.product_model',
                'kit.product.product_color',
                'kit.product.product_material',
                'kit.product.product_country',
                'kit.product_category',
                'kit.product_type',
                'kit.product_brand',
                'kit.product_collection',
                'kit.product_model',
                'kit.product_color',
                'kit.product_material',
                'kit.product_country'
            )->where('people_id', $people)->get();
            foreach ($OutgoingInvoiceKit as $key => $value) {
                $OutgoingInvoiceKit[$key]["dataType"] = "OutgoingInvoiceKit";
                $actionData->push($OutgoingInvoiceKit[$key]);
            }
        }

        if ($action == "Debtor" || $action == null) {
            $Debtor = Debtor::with('user', 'people')->where('people_id', $people)->get();
            foreach ($Debtor as $key => $value) {
                $Debtor[$key]["dataType"] = "Debtor";
                $Debtor[$key]["date"] = $Debtor[$key]["date"];
                $actionData->push($Debtor[$key]);
            }
        }

        if ($action == "DebtorPay" || $action == null) {
            $DebtorPay = DebtorPay::with('user', 'people', 'cash')->where('people_id', $people)->where('pay_type', 1)->get();
            foreach ($DebtorPay as $key => $value) {
                $DebtorPay[$key]["dataType"] = "DebtorPay";
                $DebtorPay[$key]["date"] = $DebtorPay[$key]["date"];
                $actionData->push($DebtorPay[$key]);
            }
        }

        if ($action == "DebtorKilled" || $action == null) {
            $DebtorPay = DebtorPay::with('user', 'people', 'cash')->where('people_id', $people)->where('pay_type', 0)->get();
            foreach ($DebtorPay as $key => $value) {
                $DebtorPay[$key]["dataType"] = "DebtorKilled";
                $DebtorPay[$key]["date"] = $DebtorPay[$key]["date"];
                $actionData->push($DebtorPay[$key]);
            }
        }

        if ($action == "Creditor" || $action == null) {
            $Creditor = Creditor::with('user', 'people')->where('people_id', $people)->get();
            foreach ($Creditor as $key => $value) {
                $Creditor[$key]["dataType"] = "Creditor";
                $Creditor[$key]["date"] = $Creditor[$key]["date"];
                $actionData->push($Creditor[$key]);
            }
        }

        if ($action == "CreditorPay" || $action == null) {
            $CreditorPay = CreditorPay::with('user', 'people', 'cash')->where('people_id', $people)->where('pay_type', 1)->get();
            foreach ($CreditorPay as $key => $value) {
                $CreditorPay[$key]["dataType"] = "CreditorPay";
                $CreditorPay[$key]["date"] = $CreditorPay[$key]["date"];
                $actionData->push($CreditorPay[$key]);
            }
        }

        if ($action == "CreditorKilled" || $action == null) {
            $CreditorPay = CreditorPay::with('user', 'people', 'cash')->where('people_id', $people)->where('pay_type', 0)->get();
            foreach ($CreditorPay as $key => $value) {
                $CreditorPay[$key]["dataType"] = "CreditorKilled";
                $CreditorPay[$key]["date"] = $CreditorPay[$key]["date"];
                $actionData->push($CreditorPay[$key]);
            }
        }

        $actionData = $actionData->sortByDesc('date')->paginate();

        return $actionData;
    }
}
