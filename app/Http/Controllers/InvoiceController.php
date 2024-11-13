<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {


        // Insert the invoice into the database
        DB::table('invoices')->insert([
            'ms' => $request->ms,
            'invoice_no' => $request->invoice_no,
            'gstin' => $request->gstin,
            'invoice_date' => $request->invoice_date,
            'state' => $request->state,
            'state_code' => $request->state_code,
            'subtotal' => $request->subtotal,
            'freight' => $request->freight,
            'cgst' => $request->cgst,
            'sgst' => $request->sgst,
            'igst' => $request->igst,
            'grand_total' => $request->grand_total,
            'grand_total_in_words' => $request->grand_total_words,
        ]);

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

        // Flash success message
        session()->flash('success', 'Invoice created successfully.');

        // Redirect to the 'welcome' route
        return redirect()->route('welcome');
    }

    public function destroy($id)
    {
        DB::table('invoices')->where('id', $id)->delete();
        DB::table('invoice_items')->where('invoice_id', $id)->delete();

        session()->flash('success', 'Invoice deleted successfully.');
        return redirect()->route('existing-bills');
    }

    public function show($id)
    {
        $invoice = DB::table('invoices')->where('id', $id)->first();
        $items = DB::table('invoice_items')->where('invoice_id', $id)->get();
        return view('invoice-show', compact('invoice', 'items'));
    }

    public function edit($id)
    {
        // Retrieve the invoice details by ID
        $invoice = DB::table('invoices')->where('id', $id)->first();

        // Retrieve the items for this invoice
        $items = DB::table('invoice_items')->where('invoice_id', $id)->get();

        // Pass the invoice and items to the edit view
        return view('edit', compact('invoice', 'items'));
    }

    public function update(Request $request, $id)
    {
        // Update the invoice in the database
        DB::table('invoices')->where('id', $id)->update([
            'ms' => $request->ms,
            'invoice_no' => $request->invoice_no,
            'gstin' => $request->gstin,
            'invoice_date' => $request->invoice_date,
            'state' => $request->state,
            'state_code' => $request->state_code,
            'subtotal' => $request->subtotal,
            'freight' => $request->freight,
            'cgst' => $request->cgst,
            'sgst' => $request->sgst,
            'igst' => $request->igst,
            'grand_total' => $request->grand_total,
            'grand_total_in_words' => $request->grand_total_words,
        ]);

        // Update the invoice items
        foreach ($request->items as $item) {
            DB::table('invoice_items')->where('id', $item['id'])->update([
                's_no' => $item['s_no'],
                'description' => $item['description'],
                'hsn_code' => $item['hsn_code'],
                'quantity' => $item['quantity'],
                'rate' => $item['rate'],
                'total_price' => $item['total_price'],
            ]);
        }

        // Flash success message
        session()->flash('success', 'Invoice updated successfully.');

        // Redirect to the 'invoices.index' page
        return redirect()->route('existing-bills');
    }


}
