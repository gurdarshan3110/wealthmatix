<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use DataTables;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Banks Master';

    public function index()
    {
        $stores = Store::all();

        $title = self::TITLE;

        return view('store.index', compact('stores', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add New Bank';

        return view('store.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:stores|string|max:255',
            'status' => 'required'
        ]);

        $store = Store::create($input);

        return redirect()->route('stores.index', $store->id)->with('success', 'Store created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Bank Details';
        $store = Store::find($id);

        return view('store.show', compact('store', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $title = 'Edit Bank';

        return view('store.edit', compact('store', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:stores,name,' . $store->id . '|string|max:255',
            'status' => 'required'
        ]);

        $store->update($input);

        return redirect()->route('stores.index')
                         ->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('store.index')
                         ->with('success', 'Store deleted successfully.');
    }

    public function list()
    {
        $data = Store::all();

        return DataTables::of($data)

            ->addColumn('name', function ($row) {
                $name = $row->name;

                return $name;
            })

            ->addColumn('status', function ($row) {
                $status = (($row->status == 1) ? 'Active' : 'Inactive');

                return $status;
            })
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '<form action="'.route('stores.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('stores.edit', [$row]).'"
                       class="btn btn-warning btn-xs">
                        <i class="far fa-edit"></i>
                    </a>
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(\''.$msg.'\')"><i class="far fa-trash-alt"></i></button>
                    
                </div>
                </form>';

                return $action;
            })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $stores = Store::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($stores);
    }

    public function selectStore(Request $request)
    {
        if($request->input('store_id')==null){
            $store = Store::latest()->first();
            $store = ((!empty($store))?$store->id:'');
        }else{
            $store = $request->input('store_id');
        }
        Session::put('store_id', $store);

        return response()->json(['success' => true]);
    }

}
