<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-mono bg-gray-100">
    @include('header')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center mb-6 text-blue-700">Edit Invoice</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Edit Invoice Form -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Invoice Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-4">Invoice Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Invoice Number -->
                        <div>
                            <label for="invoice_no" class="block text-sm font-medium">Invoice No</label>
                            <input type="text" name="invoice_no" id="invoice_no" value="{{ old('invoice_no', $invoice->invoice_no) }}" class="mt-1 p-2 w-full border rounded" required>
                        </div>

                        <!-- MS -->
                        <div>
                            <label for="ms" class="block text-sm font-medium">M/s</label>
                            <input type="text" name="ms" id="ms" value="{{ old('ms', $invoice->ms) }}" class="mt-1 p-2 w-full border rounded" required>
                        </div>

                        <!-- Invoice Date -->
                        <div>
                            <label for="invoice_date" class="block text-sm font-medium">Invoice Date</label>
                            <input type="text" name="invoice_date" id="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date) }}" class="mt-1 p-2 w-full border rounded" required>
                        </div>

                        <!-- GSTIN -->
                        <div>
                            <label for="gstin" class="block text-sm font-medium">GSTIN</label>
                            <input type="text" name="gstin" id="gstin" value="{{ old('gstin', $invoice->gstin) }}" class="mt-1 p-2 w-full border rounded" required>
                        </div>

                        <!-- State -->
                        <div>
                            <label for="state" class="block text-sm font-medium">State</label>
                            <input type="text" name="state" id="state" value="{{ old('state', $invoice->state) }}" class="mt-1 p-2 w-full border rounded" required>
                        </div>

                        <!-- State Code -->
                        <div>
                            <label for="state_code" class="block text-sm font-medium">State Code</label>
                            <input type="text" name="state_code" id="state_code" value="{{ old('state_code', $invoice->state_code) }}" class="mt-1 p-2 w-full border rounded" required>
                        </div>
                    </div>
                </div>

                <!-- Invoice Items -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-4">Invoice Items</h2>
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">S.No</th>
                                <th class="border px-4 py-2">Description</th>
                                <th class="border px-4 py-2">HSN Code</th>
                                <th class="border px-4 py-2">Quantity</th>
                                <th class="border px-4 py-2">Rate</th>
                                <th class="border px-4 py-2">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr class="hover:bg-gray-50">
                                    <input type="hidden" name="items[{{ $loop->index }}][id]" value="{{ $item->id }}">
                                    <td class="border px-4 py-2">
                                        <input type="text" name="items[{{ $loop->index }}][s_no]" value="{{ old('items.' . $loop->index . '.s_no', $item->s_no) }}" class="p-2 w-full border rounded" required>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="items[{{ $loop->index }}][description]" value="{{ old('items.' . $loop->index . '.description', $item->description) }}" class="p-2 w-full border rounded" required>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="text" name="items[{{ $loop->index }}][hsn_code]" value="{{ old('items.' . $loop->index . '.hsn_code', $item->hsn_code) }}" class="p-2 w-full border rounded">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="items[{{ $loop->index }}][quantity]" value="{{ old('items.' . $loop->index . '.quantity', $item->quantity) }}" class="p-2 w-full border rounded" required>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="items[{{ $loop->index }}][rate]" value="{{ old('items.' . $loop->index . '.rate', $item->rate) }}" class="p-2 w-full border rounded" required>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="items[{{ $loop->index }}][total_price]" value="{{ old('items.' . $loop->index . '.total_price', $item->total_price) }}" class="p-2 w-full border rounded" required>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Invoice Totals -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="subtotal" class="block text-sm font-medium">Sub Total</label>
                        <input type="text" name="subtotal" id="subtotal" value="{{ old('subtotal', $invoice->subtotal) }}" class="mt-1 p-2 w-full border rounded" required>
                    </div>
                    <div>
                        <label for="freight" class="block text-sm font-medium">Freight</label>
                        <input type="text" name="freight" id="freight" value="{{ old('freight', $invoice->freight) }}" class="mt-1 p-2 w-full border rounded" required>
                    </div>
                    <div>
                        <label for="cgst" class="block text-sm font-medium">CGST</label>
                        <input type="text" name="cgst" id="cgst" value="{{ old('cgst', $invoice->cgst) }}" class="mt-1 p-2 w-full border rounded" required>
                    </div>
                    <div>
                        <label for="sgst" class="block text-sm font-medium">SGST</label>
                        <input type="text" name="sgst" id="sgst" value="{{ old('sgst', $invoice->sgst) }}" class="mt-1 p-2 w-full border rounded" required>
                    </div>
                    <div>
                        <label for="igst" class="block text-sm font-medium">IGST</label>
                        <input type="text" name="igst" id="igst" value="{{ old('igst', $invoice->igst) }}" class="mt-1 p-2 w-full border rounded" required>
                    </div>
                    <div>
                        <label for="grand_total" class="block text-sm font-medium">Grand Total</label>
                        <input type="text" name="grand_total" id="grand_total" value="{{ old('grand_total', $invoice->grand_total) }}" class="mt-1 p-2 w-full border rounded" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Update Invoice</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mb-12 p-4 flex justify-center gap-6">
        <a href="{{ route('welcome') }}"
            class="w-1/2 sm:w-1/3 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none text-center">
            Back to Main Page
        </a>
        <a href="{{ route('existing-bills') }}"
            class="w-1/2 sm:w-1/3 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 focus:outline-none text-center">
            View Existing Bills
        </a>
    </div>
</body>

</html>
