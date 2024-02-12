<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Item;
use App\Models\Variant;
use App\Models\VariantAttribute;
use App\Models\Category;
use App\Models\Store;
use App\Models\TaxDetail;
use App\Models\Unit;
use App\Models\User;
use DataTables;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Items Variants';

    public function index()
    {
        $title = self::TITLE;

        return view('variant.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add New Variant';
        return view('variant.create', compact('title'));
    }

    /**
     * Variant a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:variants|string|max:255',
            'item_id' =>'required|integer',
            'unit_id' =>'required|integer',
            'status' => 'required'
        ]);

        $variant = Variant::create($input);

        return redirect()->route('variants.index', $variant->id)->with('success', 'Variant created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Variant Details';
        $variant = Variant::find($id);

        return view('variant.show', compact('variant', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Variant $variant)
    {
        $title = 'Edit Variant';

        return view('variant.edit', compact('variant', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variant $variant)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:variants,name,' . $variant->id . '|string|max:255',
            'item_id' =>'required|integer',
            'unit_id' =>'required|integer',
            'status' => 'required'
        ]);

        $variant->update($input);

        return redirect()->route('variants.index')
                         ->with('success', 'Variant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variant $variant)
    {
        $variant->delete();

        return redirect()->route('variant.index')
                         ->with('success', 'Variant deleted successfully.');
    }

    public function list()
    {
        $data = Variant::with('item','unit')->get();
        //dd($data);
        return DataTables::of($data)

            // ->addColumn('image', function ($row) {
            //     $image = '<img src="'.$row->media.'" class="variant-image"/>';

            //     return $image;
            // })

            ->addColumn('name', function ($row) {
                $name = $row->name;

                return $name;
            })

            ->addColumn('item', function ($row) {
                $item = $row->item->name;

                return $item;
            })

            ->addColumn('unit', function ($row) {
                $unit = $row->unit->name;

                return $unit;
            })


            ->addColumn('status', function ($row) {
                $status = (($row->status == 1) ? 'Active' : 'Inactive');

                return $status;
            })
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '<form action="'.route('variants.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('variants.edit', [$row]).'"
                       class="btn btn-warning btn-xs">
                        <i class="far fa-edit"></i>
                    </a>
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(\''.$msg.'\')"><i class="far fa-trash-alt"></i></button>
                    
                </div>
                </form>';

                return $action;
            })
        ->rawColumns(['image','action'])
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
                $results[] = [
                    'name' => $item->name.' '.$variant->name,
                    'id' => $variant->id,
                ];
            }
        }

        return response()->json($results);
    }

}
