<?php

namespace App\Exports;


use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Models\Creditor\Creditor;
use App\Models\Creditor\CreditorPay;
use App\Models\Debtor\Debtor;
use App\Models\Debtor\DebtorPay;
use App\Models\IncomingInvoice\IncomingInvoice;
use App\Models\OutgoingInvoice\OutgoingInvoice;
use App\Models\People\People;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;

class PeopleExport implements FromCollection, WithStyles
{
    protected $people;

    public function __construct(int $people)
    {
        $this->people = $people;
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1   => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => COLOR::COLOR_BLUE]
                ],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => COLOR::COLOR_WHITE],
                ]
            ],
            2   => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => COLOR::COLOR_BLUE]
                ],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => COLOR::COLOR_WHITE],
                ]
            ],
            3    => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => COLOR::COLOR_WHITE]
                ],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => COLOR::COLOR_BLACK],
                ]
            ],

        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $people = People::where('id', $this->people)->get();

        $actionData = collect([]);



        //Get Row Data

        $IncomingInvoice = IncomingInvoice::with('cash')->where('people_id', $this->people)->get();
        foreach ($IncomingInvoice as $key => $value) {
            $IncomingInvoice[$key]["dataType"] = "IncomingInvoice";
            $actionData->push($IncomingInvoice[$key]);
        }
        $OutgoingInvoice = OutgoingInvoice::with('cash')->where('people_id', $this->people)->get();
        foreach ($OutgoingInvoice as $key => $value) {
            $OutgoingInvoice[$key]["dataType"] = "OutgoingInvoice";
            $actionData->push($OutgoingInvoice[$key]);
        }
        $Debtor = Debtor::where('people_id', $this->people)->get();
        foreach ($Debtor as $key => $value) {
            $Debtor[$key]["dataType"] = "Debtor";
            $actionData->push($Debtor[$key]);
        }
        $DebtorPay = DebtorPay::with('cash')->where('people_id', $this->people)->get();
        foreach ($DebtorPay as $key => $value) {
            $DebtorPay[$key]["dataType"] = "DebtorPay";
            $actionData->push($DebtorPay[$key]);
        }
        $Creditor = Creditor::where('people_id', $this->people)->get();
        foreach ($Creditor as $key => $value) {
            $Creditor[$key]["dataType"] = "Creditor";
            $actionData->push($Creditor[$key]);
        }
        $CreditorPay = CreditorPay::with('cash')->where('people_id', $this->people)->get();
        foreach ($CreditorPay as $key => $value) {
            $CreditorPay[$key]["dataType"] = "CreditorPay";
            $actionData->push($CreditorPay[$key]);
        }

        $peopleData = collect([]);
        $peopleData->push(
            [
                "",
                "",
                "",
                "العميل",
                "رقم الهاتف",
                "العنوان",
                "إجمالى الرصيد"
            ]
        );
        $peopleData->push(
            [
                "",
                "",
                "",
                $people[0]->name,
                $people[0]->phone,
                $people[0]->address,
                $people[0]->total_credit
            ]
        );
        $peopleData->push(
            [
                "التاريخ",
                "النوع",
                "وصف العمليه",
                "نوع الدفع",
                "مدين",
                "دائن",
                "لرصيد الختامى"
            ]
        );

        $totalCr = (float)0;

        $actionData = $actionData->sortByDesc('date');
        foreach ($actionData as $key => $value) {
            switch ($actionData[$key]["dataType"]) {
                case 'IncomingInvoice':
                    if ($actionData[$key]["pay_type"] == 0) {
                        $totalCr -= $actionData[$key]["total"];
                        $peopleData->push(
                            [
                                $actionData[$key]["date"],
                                "فاتوره وارده",
                                $actionData[$key]["number"],
                                "على الحساب",
                                $actionData[$key]["total"],
                                "-",
                                (float)$totalCr
                            ]
                        );
                    } else {
                        $peopleData->push(
                            [
                                $actionData[$key]["date"],
                                "فاتوره وارده",
                                $actionData[$key]["number"],
                                $actionData[$key]["cash"]["title"],
                                "-",
                                $actionData[$key]["total"],
                                (float)$totalCr
                            ]
                        );
                    }

                    break;
                case 'OutgoingInvoice':
                    if ($actionData[$key]["pay_type"] == 0) {
                        $totalCr += $actionData[$key]["total"];
                        $peopleData->push(
                            [
                                $actionData[$key]["date"],
                                "فاتوره صادره",
                                $actionData[$key]["id"],
                                "على الحساب",
                                $actionData[$key]["total"],
                                "-",
                                (float)$totalCr
                            ]
                        );
                    } else {
                        $peopleData->push(
                            [
                                $actionData[$key]["date"],
                                "فاتوره صادره",
                                $actionData[$key]["id"],
                                $actionData[$key]["cash"]["title"],
                                "-",
                                $actionData[$key]["total"],
                                (float)$totalCr
                            ]
                        );
                    }
                    break;
                case 'Debtor':
                    $totalCr += $actionData[$key]["amount"];
                    $peopleData->push(
                        [
                            $actionData[$key]["date"],
                            "دين مدين",
                            $actionData[$key]["title"],
                            "دين",
                            "-",
                            $actionData[$key]["amount"],
                            (float)$totalCr
                        ]
                    );
                    break;
                case 'DebtorPay':
                    $totalCr -= $actionData[$key]["amount"];
                    if ($actionData[$key]["pay_type"] == 0) {
                        $peopleData->push(
                            [
                                $actionData[$key]["date"],
                                "دفعه وارده",
                                $actionData[$key]["title"],
                                "معدم",
                                "-",
                                $actionData[$key]["amount"],
                                (float)$totalCr
                            ]
                        );
                    } else {
                        $peopleData->push(
                            [
                                $actionData[$key]["date"],
                                "دفعه وارده",
                                $actionData[$key]["title"],
                                $actionData[$key]["cash"]["title"],
                                "-",
                                $actionData[$key]["amount"],
                                (float)$totalCr
                            ]
                        );
                    }
                    break;
                case 'Creditor':
                    $totalCr -= $actionData[$key]["amount"];
                    $peopleData->push(
                        [
                            $actionData[$key]["date"],
                            "دين دائن",
                            $actionData[$key]["title"],
                            "دين",
                            $actionData[$key]["amount"],
                            "-",
                            (float)$totalCr
                        ]
                    );
                    break;
                case 'CreditorPay':
                    $totalCr += $actionData[$key]["amount"];
                    if ($actionData[$key]["pay_type"] == 0) {
                        $peopleData->push(
                            [
                                $actionData[$key]["date"],
                                "دفعه صادره",
                                $actionData[$key]["title"],
                                "معدم",
                                $actionData[$key]["amount"],
                                "-",
                                (float)$totalCr
                            ]
                        );
                    } else {
                        $peopleData->push(
                            [
                                $actionData[$key]["date"],
                                "دفعه صادره",
                                $actionData[$key]["title"],
                                $actionData[$key]["cash"]["title"],
                                $actionData[$key]["amount"],
                                "-",
                                (float) $totalCr
                            ]
                        );
                    }

                    break;
                default:
                    # code...
                    break;
            }
        }

        return $peopleData;
    }
}
