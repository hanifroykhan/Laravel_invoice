<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Invoice_detail;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice  = Invoice::with(['customer', 'detail'])->orderBy('created_at', 'DESC')->paginate(10);
        return [
            "status" => 1,
            "data" => $invoice
        ];
    }
    
    public function show(Invoice $invoice)
    {
        return [
            "status" => 1,
            "data" => $invoice
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id',
        ]);

        try {
            $invoice = Invoice::create([
                'customer_id' => $request->customer_id,
                'total' => 0
            ]);
			
            return response()->json([
                "success" => true,
                "data" => $invoice
            ],200);
        } catch(\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ],500);
        }
    }

    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer',
            'id' => 'required|numeric|exists:invoices,id'
        ]);

        try {
            $invoice = Invoice::find($id);
            $product = Product::find($request->product_id);
            $invoice_detail = $invoice->detail()->where('product_id', $product->id)->first();
            
            if ($invoice_detail) {
                $invoice_detail->update([
                    'qty' => $invoice_detail->qty + $request->qty,
                    'invoice_id'  => $invoice->id
                ]);
            } else {
                Invoice_detail::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $request->product_id,
                    'price' => $product->price,
                    'qty' => $request->qty
                ]);
            }
            
            return response()->json([
                "success" => true,
                "data" => $invoice_detail
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return [
            "status" => 1,
            "data" => $invoice,
            "message" => "data deleted successfully"
        ];

    }
    
}
