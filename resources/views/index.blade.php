<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @include('header')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-center mb-6">All Bills</h1>
        @if(session('success'))
            <div class="bg-green-200 text-green-800 border border-green-600 py-2 px-4 mb-4 text-center rounded">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Bills Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Invoice No</th>
                        <th class="py-3 px-6 text-left">M/S Name</th>
                        <th class="py-3 px-6 text-left">Invoice Date</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach($invoices as $index => $invoice)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-left">{{ $invoice->invoice_no }}</td>
                            <td class="py-3 px-6 text-left">{{ $invoice->ms }}</td>
                            <td class="py-3 px-6 text-left">{{ $invoice->invoice_date }}</td>
                            <td class="py-3 px-6 text-center flex justify-center space-x-2">
                                <!-- View Button -->
                                <a href="{{ route('invoices.show', $invoice->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    View
                                </a>
                                
                                <!-- Update Button -->
                                <a href="{{ route('invoices.edit', $invoice->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    Update
                                </a>
                                
                                <!-- Delete Button with Confirmation -->
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this bill?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('footer');
</body>
</html>
