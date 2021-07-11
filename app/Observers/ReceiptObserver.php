<?php

namespace App\Observers;

use App\Receipt;

class ReceiptObserver
{
    /**
     * Handle the receipt "created" event.
     *
     * @param  \App\Receipt  $receipt
     * @return void
     */
    public function created(Receipt $receipt)
    {
        \LogActivity::addToLog('Registró el tipo de recibo: '.$receipt->name);
    }

    /**
     * Handle the receipt "updated" event.
     *
     * @param  \App\Receipt  $receipt
     * @return void
     */
    public function updated(Receipt $receipt)
    {
        \LogActivity::addToLog('Modificó el tipo de recibo: '.$receipt->name);
    }

    /**
     * Handle the receipt "deleted" event.
     *
     * @param  \App\Receipt  $receipt
     * @return void
     */
    public function deleted(Receipt $receipt)
    {
        \LogActivity::addToLog('Eliminó el tipo de recibo: '.$receipt->name);
    }

    /**
     * Handle the receipt "restored" event.
     *
     * @param  \App\Receipt  $receipt
     * @return void
     */
    public function restored(Receipt $receipt)
    {
        \LogActivity::addToLog('Restauró el tipo de recibo: '.$receipt->name);
    }

    /**
     * Handle the receipt "force deleted" event.
     *
     * @param  \App\Receipt  $receipt
     * @return void
     */
    public function forceDeleted(Receipt $receipt)
    {
        //
    }
}
