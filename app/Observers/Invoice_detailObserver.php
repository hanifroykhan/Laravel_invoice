<?php

namespace App\Observers;

use App\Models\Invoice_detail;
use App\Models\Invoice;
class Invoice_detailObserver
{
    /**
     * Handle the Invoice_detail "created" event.
     *
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return void
     */
    private function generateTotal($invoiceDetail)
    {
        $invoice_id = $invoiceDetail->invoice_id;
        $invoice_detail = Invoice_detail::where('invoice_id', $invoice_id)->get();
        $total = $invoice_detail->sum(function($i) {
            return $i->price * $i->qty;
        });
       
        $invoiceDetail->invoice()->update([
            'total' => $total
        ]);
    }
    public function created(Invoice_detail $invoiceDetail)
    {
        $this->generateTotal($invoiceDetail);
    }

    /**
     * Handle the Invoice_detail "updated" event.
     *
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return void
     */
    public function updated(Invoice_detail $invoiceDetail)
    {
        $this->generateTotal($invoiceDetail);
    }

    /**
     * Handle the Invoice_detail "deleted" event.
     *
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return void
     */
    public function deleted(Invoice_detail $invoiceDetail)
    {
        $this->generateTotal($invoiceDetail);
    }

    /**
     * Handle the Invoice_detail "restored" event.
     *
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return void
     */
    public function restored(Invoice_detail $invoice_detail)
    {
        //
    }

    /**
     * Handle the Invoice_detail "force deleted" event.
     *
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return void
     */
    public function forceDeleted(Invoice_detail $invoice_detail)
    {
        //
    }
}
