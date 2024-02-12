<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Variant;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Store;
use Carbon\Carbon;

class ImportDataController extends Controller
{
    
    const TITLE = 'Import Data';

    public function index()
    {
        $title = self::TITLE;

        return view('import.index', compact('title'));
    }


    public function store(Request $request)
    {
        $file = $request->file('file');
        $csvData = array_map('str_getcsv', file($file));
        $isFirstRow = true;
        foreach ($csvData as $row) {
            if($isFirstRow){
                $isFirstRow=false;
            }else{
                $catName = strtoupper($row[1]);
                $category = Category::where('name',$catName)->where('parent',null)->first();
                if($category=='' && $catName!=''){
                    $category = Category::create([
                        'name' => $catName, 
                        'status' => 1,
                    ]);
                }

                $subCatName = strtoupper($row[4]);
                $subcategory = Category::where('name',$subCatName)->where('parent',$category->id)->first();
                if($subcategory=='' && $subCatName!=''){
                    $subcategory = Category::create([
                        'name' => $subCatName, 
                        'status' => 1,
                        'parent' => $category->id
                    ]);
                }

                $unitName = strtoupper($row[2]);
                if($unitName==''){
                    $unitName = 'No Unit';
                }
                $unit = Unit::where('name',$unitName)->first();
                if($unit=='' && $unitName!=''){
                    $unit = Unit::create([
                        'name' => $unitName, 
                        'status' => 1
                    ]);
                }

                $itemName = strtoupper($row[0]);
                $item = Item::where('name',$itemName)->first();
                if($item=='' && $itemName!=''){
                    $item = Item::create([
                        'name' => $itemName, 
                        'category_id' => $category->id,
                        'status' => 1
                    ]);
                }

                $variantName = strtoupper('Wgt '.$row[3].' Qty '.$row[6]);
                $variant = Variant::where('name',$variantName)->first();
                if($variant=='' && $variantName!=''){
                    $variant = Variant::create([
                        'name' => $variantName, 
                        'item_id' => $item->id,
                        'unit_id' => $unit->id,
                        'status' => 1
                    ]);
                }

                $manDate = date('Y-m-d',strtotime($row[5]));
                $expDate = date('Y-m-d',strtotime($row[9]));
                if($expDate=='-0001-11-30'){
                    $date = Carbon::parse($manDate); 
                    $expDate = $date->addMonths(36);
                }
                $batchNo = $row[7];
                $qty = $row[8];
                $storeName = 'Ludhiana';

                $store = Store::where('name',$storeName)->first();
                if($store=='' && $storeName!=''){
                    $store = Store::create([
                        'name' => $storeName, 
                        'status' => 1
                    ]);
                }
                
                $inventory = Inventory::create([
                    'store_id' => $store->id, 
                    'variant_id' => $variant->id,
                    'batch_no' => $batchNo,
                    'quantity' => $qty,
                    'expiry_date' => $expDate,
                    'manufacture_date' => $manDate,
                    'action_date' => date('Y-m-d'),
                    'type' =>Inventory::STOCK_TYPE_IN_VAL,
                    'status' => 1
                ]);
            }

        };
        return redirect()->route('import.index', 'success')->with('success', 'Data imported successfully.');
    }
}
