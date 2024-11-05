<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    // Show the form to create a new invoice
    public function create()
    {
        return view('create'); // Create a view for invoice creation
    }

    // Store a new invoice in the database
    public function store(Request $request)
    {
        $request->validate([
            'ms' => 'required|string|max:255',
            'invoice_no' => 'required|string|max:100',
            'gstin' => 'required|string|max:50',
            'invoice_date' => 'required|date',
            'state' => 'required|string|max:100',
            'state_code' => 'required|string|max:10',
            'subtotal' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'grand_total_in_words' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*.s_no' => 'required|integer',
            'items.*.description' => 'required|string|max:255',
            'items.*.hsn_code' => 'nullable|string|max:20',
            'items.*.quantity' => 'required|integer',
            'items.*.rate' => 'required|numeric',
            'items.*.total_price' => 'required|numeric',
        ]);

        // Insert the invoice into the database
        DB::table('invoices')->insert([
            'ms' => $request->ms,
            'invoice_no' => $request->invoice_no,
            'gstin' => $request->gstin,
            'invoice_date' => $request->invoice_date,
            'state' => $request->state,
            'state_code' => $request->state_code,
            'subtotal' => $request->subtotal,
            'grand_total' => $request->grand_total,
            'grand_total_in_words' => $request->grand_total_in_words,
            // Add other fields as necessary
        ]);

        // Retrieve the last inserted invoice ID
        $invoiceId = DB::getPdo()->lastInsertId();

        // Insert the invoice items into the database
        foreach ($request->items as $item) {
            DB::table('invoice_items')->insert([
                'invoice_id' => $invoiceId,
                's_no' => $item['s_no'],
                'description' => $item['description'],
                'hsn_code' => $item['hsn_code'],
                'quantity' => $item['quantity'],
                'rate' => $item['rate'],
                'total_price' => $item['total_price'],
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    // Show all invoices
    public function index()
    {
        $invoices = DB::table('invoices')
            ->leftJoin('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->select('invoices.ms', 'invoices.invoice_no', 'invoices.gstin', 
                     DB::raw('GROUP_CONCAT(invoice_items.description) as items'))
            ->groupBy('invoices.id')
            ->get();

        return view('invoices.index', compact('invoices'));
    }
}
