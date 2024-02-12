<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Attribute;
use App\Models\User;
use DataTables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Attributes';

    public function index()
    {
        $attributes = Attribute::all();

        $title = self::TITLE;

        return view('attribute.index', compact('attributes', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add New Attribute';

        return view('attribute.create', compact('title'));
    }

    /**
     * Attribute a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:attributes|string|max:255',
            'status' => 'required'
        ]);

        $attribute = Attribute::create($input);

        return redirect()->route('attributes.index', $attribute->id)->with('success', 'Attribute created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Attribute Details';
        $attribute = Attribute::find($id);

        return view('attribute.show', compact('attribute', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $title = 'Edit Attribute';

        return view('attribute.edit', compact('attribute', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:attributes,name,' . $attribute->id . '|string|max:255',
            'status' => 'required'
        ]);

        $attribute->update($input);

        return redirect()->route('attributes.index')
                         ->with('success', 'Attribute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('attributes.index')
                         ->with('success', 'Attribute deleted successfully.');
    }

    public function list()
    {
        $data = Attribute::all();

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
                $action = '<form action="'.route('attributes.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('attributes.edit', [$row]).'"
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
        $attributes = Attribute::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($attributes);
    }

}
