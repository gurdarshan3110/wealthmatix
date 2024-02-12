<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Item;
use App\Models\Category;
use App\Models\Store;
use App\Models\TaxDetail;
use App\Models\Unit;
use App\Models\User;
use DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Items';

    public function index()
    {
        $title = self::TITLE;

        return view('item.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add New Item';
        return view('item.create', compact('title'));
    }

    /**
     * Item a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:items|string|max:255',
            'category_id' =>'required|integer',
            'tax_id' =>'required|integer',
            'status' => 'required'
        ]);

        $item = Item::create($input);

        return redirect()->route('items.index', $item->id)->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Item Details';
        $item = Item::find($id);

        return view('item.show', compact('item', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $title = 'Edit Item';

        return view('item.edit', compact('item', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:items,name,' . $item->id . '|string|max:255',
            'category_id' =>'required|integer',
            'tax_id' =>'required|integer',
            'status' => 'required'
        ]);

        $item->update($input);

        return redirect()->route('items.index')
                         ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('item.index')
                         ->with('success', 'Item deleted successfully.');
    }

    public function list()
    {
        $data = Item::with('category')->get();
        //dd($data);
        return DataTables::of($data)

            // ->addColumn('image', function ($row) {
            //     $image = '<img src="'.$row->media.'" class="item-image"/>';

            //     return $image;
            // })

            ->addColumn('name', function ($row) {
                $name = $row->name;

                return $name;
            })

            ->addColumn('category', function ($row) {
                $category = $row->category->name;

                return $category;
            })

            ->addColumn('hsn_code', function ($row) {
                $hsn_code = $row->hsn_code;

                return $hsn_code;
            })

            ->addColumn('status', function ($row) {
                $status = (($row->status == 1) ? 'Active' : 'Inactive');

                return $status;
            })
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '<form action="'.route('items.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('items.edit', [$row]).'"
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
        $items = Item::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($items);
    }

}
