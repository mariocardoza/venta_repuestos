<?php

namespace App\Observers;

use App\Percentage;

class PercentageObserver
{
    /**
     * Handle the percentage "created" event.
     *
     * @param  \App\Percentage  $percentage
     * @return void
     */
    public function created(Percentage $percentage)
    {
        \LogActivity::addToLog('Registró el porcentaje: '.$percentage->nombre);
    }

    /**
     * Handle the percentage "updated" event.
     *
     * @param  \App\Percentage  $percentage
     * @return void
     */
    public function updated(Percentage $percentage)
    {
        \LogActivity::addToLog('Modificó el porcentaje: '.$percentage->nombre);
    }

    /**
     * Handle the percentage "deleted" event.
     *
     * @param  \App\Percentage  $percentage
     * @return void
     */
    public function deleted(Percentage $percentage)
    {
        \LogActivity::addToLog('Eliminó el porcentaje: '.$percentage->nombre);
    }

    /**
     * Handle the percentage "restored" event.
     *
     * @param  \App\Percentage  $percentage
     * @return void
     */
    public function restored(Percentage $percentage)
    {
        \LogActivity::addToLog('Restauró el porcentaje: '.$percentage->nombre);
    }

    /**
     * Handle the percentage "force deleted" event.
     *
     * @param  \App\Percentage  $percentage
     * @return void
     */
    public function forceDeleted(Percentage $percentage)
    {
        //
    }
}
