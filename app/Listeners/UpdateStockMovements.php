<?php

namespace App\Listeners;

use App\Events\MRNCreated;
use App\StockMovement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStockMovements implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(MRNCreated $event)
    {
        $mrn = $event->mrn;

        foreach ($mrn->items as $item) {
            StockMovement::create([
                'item_id' => $item->id,
                'store_id' => $item->pivot->store_id, // Adjust this based on your actual store_id source
                'quantity_change' => $item->pivot->quantity,
                'movement_type' => 'mrn',
                'user_id' => $mrn->user_id,
                'status' => $mrn->status,
            ]);
        }
    }
}
