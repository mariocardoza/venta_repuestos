<?php

namespace App\Observers;

use App\Purchase;

class PurchaseObserver
{
    /**
     * Handle the purchase "created" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function created(Purchase $purchase)
    {
        \LogActivity::addToLog('Registró la compra N°: '.$purchase->bill_number .' de la persona : '.$purchase->supplier);
    }

    /**
     * Handle the purchase "updated" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function updated(Purchase $purchase)
    {
        \LogActivity::addToLog('Modificó la compra N°: '.$purchase->bill_number .' de la persona : '.$purchase->supplier);
    }

    /**
     * Handle the purchase "deleted" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function deleted(Purchase $purchase)
    {
        \LogActivity::addToLog('Eliminó la compra N°: '.$purchase->bill_number .' de la persona : '.$purchase->supplier);
    }

    /**
     * Handle the purchase "restored" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function restored(Purchase $purchase)
    {
        \LogActivity::addToLog('Restauró la compra N°: '.$purchase->bill_number .' de la persona : '.$purchase->supplier);
    }

    /**
     * Handle the purchase "force deleted" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function forceDeleted(Purchase $purchase)
    {
        //
    }
}
