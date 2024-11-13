<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }

            .printdata {
                margin-top: 0;
                margin-left: 0;
                margin-right: 0;
            }
            
        }
    </style>
</head>

<body class="font-mono">
    <div class="no-print">
        @include('header')
    </div>
    <div class="mx-2 my-6 printdata ">
        <div class="bg-gradient-to-r from-indigo-500 to-indigo-800 text-white p-4 rounded-t-lg">
            <p class="text-2xl font-bold text-center">Tax Invoice</p>
            <div class="flex justify-between items-center">
                <img src="{{ asset('images/LOGO.png') }}" alt="Logo" class="w-32 h-auto">
                <p class="text-3xl">Sakshi Enterprises</p>
                <div class="text-right">
                    <p class="text-sm font-bold">GSTIN: 07OURPS6573P1ZY</p>
                    <p class="text-sm">M.: 9650650297</p>
                </div>
            </div>
            <p class="text-sm text-center mt-4">D-435, Gali No.-59,Mahavir Enclave, Part-3, West Delhi-110059</p>
            <p class="text-sm text-center">E-mail: manojsharma.2016m@gmail.com</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full my-2 border">
                <tr>
                    <td class="border px-2 py-1" colspan="2">M/s:</td>
                    <td class="border px-2 py-1" colspan="2">{{ $invoice->ms }}</td>
                    <td class="border px-2 py-1">Invoice No:</td>
                    <td class="border px-2 py-1">{{ $invoice->invoice_no }}</td>
                </tr>
                <tr>
                    <td class="border px-2 py-1" colspan="2">GSTIN:</td>
                    <td class="border px-2 py-1" colspan="2">{{ $invoice->gstin }}</td>
                    <td class="border px-2 py-1">Date:</td>
                    <td class="border px-2 py-1">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <td class="border px-2 py-1" colspan="2">State</td>
                    <td class="border px-2 py-1" colspan="2">{{$invoice->state}}</td>
                    <td class="border px-2 py-1">State Code</td>
                    <td class="border px-2 py-1">{{$invoice->state_code}}</td>
                </tr>
            </table>
        </div>

        <table class="w-full table-auto border my-2">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-2 py-1">S.No</th>
                    <th class="border px-2 py-1">Description</th>
                    <th class="border px-2 py-1">HSN/SAC Code</th>
                    <th class="border px-2 py-1">Quantity</th>
                    <th class="border px-2 py-1">Rate</th>
                    <th class="border px-2 py-1">Total Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                    <tr class="text-center">
                        <td class="border px-2 py-1">{{ $index + 1 }}</td>
                        <td class="border px-2 py-1">{{ $item->description }}</td>
                        <td class="border px-2 py-1">{{ $item->hsn_code }}</td>
                        <td class="border px-2 py-1">{{ $item->quantity }}</td>
                        <td class="border px-2 py-1">{{ number_format($item->rate, 2) }}</td>
                        <td class="border px-2 py-1">{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
                <tr className="bg-gray-0">
                    <td colSpan="3" rowSpan="6" className="border border-black px-1 py-1">Grand Total (In Words): <span
                            className="font-semibold">{{$invoice->grand_total_in_words}}</span></td>
                    <td colSpan="2" className="border border-black px-1 py-1">Subtotal:</td>
                    <td className="border border-black px-1 py-1">{{$invoice->subtotal}}</td>
                </tr>
                <tr className="bg-gray-0">
                    <td colSpan="2" className="border border-black px-1 py-1">Freight</td>
                    <td className="border border-black px-1 py-1">{{$invoice->freight}}</td>
                </tr>
                <tr className="bg-gray-0">
                    <td colSpan="2" className="border border-black px-1 py-1">CGST:</td>
                    <td className="border border-black px-1 py-1">{{$invoice->cgst}}</td>
                </tr>
                <tr className="bg-gray-0">
                    <td colSpan="2" className="border border-black px-1 py-1">SGST</td>
                    <td className="border border-black px-1 py-1">{{$invoice->sgst}}</td>
                </tr>
                <tr className="bg-gray-0">
                    <td colSpan="2" className="border border-black px-1 py-1">IGST</td>
                    <td className="border border-black px-1 py-1">{{$invoice->igst}}</td>
                </tr>
                <tr className="bg-gray-0">
                    <td colSpan="2" className="border border-black px-1 py-1">Grand Total:</td>
                    <td className="border border-black px-1 py-1">{{$invoice->grand_total}}</td>
                </tr>
            </tbody>

        </table>
        <div class="p-2 px-8 flex justify-between mt-2">
            <div>
                <p class="text-xs text-gray-500">Terms & Conditions: </p>
                <ul class="list-disc pl-4 text-sm text-gray-600 text-left">
                    <li>All disputes are subject to jurisdiction of Delhi Courts</li>
                    <li>Payment should be made by cash/cheque/draft only.</li>
                    <li>Late payment will be charged if bill unpaid for 15 days.</li>
                </ul>
            </div>
            <div class="text-right flex flex-col justify-end items-end">
                <p class="text-sm">For Sakshi Enterprises</p>
                <p class="text-sm mt-8">Authorised Signatory</p>
            </div>
        </div>


        <div class="p-4 text-right no-print mb-6">
            <a href="{{ route('existing-bills') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Go Back</a>
            <button onclick="window.print()" class="bg-green-500 text-white px-4 py-2 ml-2 rounded hover:bg-green-700 transition">Print</button>
        </div>
    </div>
    <div class="no-print">
        @include('footer')
    </div>
</body>

</html>