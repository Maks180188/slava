<?php

namespace App\Observers;

use App\Models\Row;
use Illuminate\Support\Facades\Redis;

class RowObserver
{
    /**
     * Handle the Row "created" event.
     */
    public function created(Row $row): void
    {
        Redis::set('count', Redis::get('count') + 1);

    }

    /**
     * Handle the Row "updated" event.
     */
    public function updated(Row $row): void
    {
        //
    }

    /**
     * Handle the Row "deleted" event.
     */
    public function deleted(Row $row): void
    {
        //
    }

    /**
     * Handle the Row "restored" event.
     */
    public function restored(Row $row): void
    {
        //
    }

    /**
     * Handle the Row "force deleted" event.
     */
    public function forceDeleted(Row $row): void
    {
        //
    }
}
