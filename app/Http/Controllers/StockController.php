<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Variant;
use App\Models\Inventory;
use DataTables;

class StockController extends Controller
{
    const TITLE = 'Stocks';

    public function index()
    {
        $title = self::TITLE;

        return view('stock.index', compact('title'));
    }

    public function list()
    {
        $data = Inventory::with(['variant.item', 'variant'])
            ->where('store_id', session('store_id'))
            ->groupBy('variant_id')
            ->select('variant_id')
            ->get();

        return DataTables::of($data)


            ->addColumn('item', function ($row) {
                $item = $row->variant->item->name;

                return $item;
            })

            ->addColumn('variant', function ($row) {
                $variant = $row->variant->name;

                return $variant;
            })

            ->addColumn('quantity', function ($row) {
                $quantity = $row->actual_quantity;

                return $quantity;
            })

            
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '
                    <a href=""
                       class="btn btn-warning btn-xs">
                        <i class="far fa-edit"></i>
                    </a>
                    ';

                return $action;
            })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for items with a name matching the query
        $items = Item::where('name', 'LIKE', "%{$query}%")->get();

        $results = [];

        // For each item found, fetch its variants and add them to the results
        foreach ($items as $item) {
            $variants = $item->variants()->get();
            foreach ($variants as $variant) {
                // Retrieve the latest inventory record for the variant
                $latestInventory = Inventory::where('variant_id', $variant->id)
                    ->where('store_id', session('store_id'))
                    ->where('status', Inventory::STOCK_STATUS_ACTIVE_VAL)
                    ->latest('action_date')
                    ->first();

                // Add relevant data to the results
                $results[] = [
                    'name' => $item->name.' '.$variant->name,
                    'id' => $variant->id,
                    'batch_no' => $latestInventory ? $latestInventory->batch_no : null,
                    'manufacture_date' => $latestInventory ? $latestInventory->manufacture_date : null,
                    'expiry_date' => $latestInventory ? $latestInventory->expiry_date : null,
                    'unit_price' => $latestInventory ? $latestInventory->unit_price : null,
                    'actual_quantity' => $latestInventory ? $latestInventory->actual_quantity : 0,
                ];
            }
        }

        return response()->json($results);
    }

}
