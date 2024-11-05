<!-- resources/views/invoices/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css') {{-- If you're using Vite for asset bundling --}}
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-3xl w-full bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Create Invoice</h1>
        <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- General Invoice Fields -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <input type="text" name="ms" placeholder="M/s" class="input-field" required>
                <input type="text" name="invoice_no" placeholder="Invoice No" class="input-field" required>
                <input type="text" name="gstin" placeholder="GSTIN" class="input-field" required>
                <input type="date" name="invoice_date" class="input-field" required>
                <input type="text" name="state" placeholder="State" class="input-field" required>
                <input type="text" name="state_code" placeholder="State Code" class="input-field" required>
                <input type="number" name="subtotal" placeholder="Subtotal" class="input-field" step="0.01" required>
                <input type="number" name="grand_total" placeholder="Grand Total" class="input-field" step="0.01" required>
                <input type="text" name="grand_total_in_words" placeholder="Grand Total in Words" class="input-field" required>
            </div>

            <h3 class="text-xl font-semibold text-gray-700 mt-8">Invoice Items</h3>
            <div id="items" class="space-y-4">
                <!-- Placeholder for dynamically added item fields -->
            </div>

            <button type="button" onclick="addItem()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none">Add Item</button>

            <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded mt-6 hover:bg-green-600 focus:outline-none">Create Invoice</button>
        </form>
    </div>

    <script>
        // Function to add a new item row
        function addItem() {
            const itemsDiv = document.getElementById('items');
            const itemCount = itemsDiv.children.length;

            const newItemDiv = document.createElement('div');
            newItemDiv.classList.add('item', 'p-4', 'bg-gray-50', 'rounded', 'shadow-sm', 'grid', 'grid-cols-1', 'md:grid-cols-6', 'gap-4');

            newItemDiv.innerHTML = `
                <input type="number" name="items[${itemCount}][s_no]" placeholder="S.No" class="input-field" required>
                <input type="text" name="items[${itemCount}][description]" placeholder="Description" class="input-field" required>
                <input type="text" name="items[${itemCount}][hsn_code]" placeholder="HSN Code" class="input-field">
                <input type="number" name="items[${itemCount}][quantity]" placeholder="Quantity" class="input-field" required>
                <input type="number" name="items[${itemCount}][rate]" placeholder="Rate" step="0.01" class="input-field" required>
                <input type="number" name="items[${itemCount}][total_price]" placeholder="Total Price" step="0.01" class="input-field" required>
                <button type="button" onclick="removeItem(this)" class="text-red-500 font-semibold hover:text-red-700 focus:outline-none">Remove</button>
            `;

            itemsDiv.appendChild(newItemDiv);
        }

        function removeItem(button) {
            button.parentElement.remove();

            const items = document.querySelectorAll('#items .item');
            items.forEach((item, index) => {
                item.querySelector('[name^="items"]').setAttribute("name", `items[${index}][s_no]`);
                item.querySelector('[name^="items"]').setAttribute("name", `items[${index}][description]`);
                item.querySelector('[name^="items"]').setAttribute("name", `items[${index}][hsn_code]`);
                item.querySelector('[name^="items"]').setAttribute("name", `items[${index}][quantity]`);
                item.querySelector('[name^="items"]').setAttribute("name", `items[${index}][rate]`);
                item.querySelector('[name^="items"]').setAttribute("name", `items[${index}][total_price]`);
            });
        }
    </script>
</body>
</html>
