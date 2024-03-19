<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Parameter;
use App\Models\User;
use DataTables;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Parameters';

    public function index()
    {
        $title = self::TITLE;

        return view('parameter.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $title = 'Add New Parameter';
        return view('parameter.create', compact('title'));
    }

    /**
     * Category a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:parameters|string|max:255',
            'status' => 'required'
        ]);

        $parameter = Parameter::create($input);

        return redirect()->route('parameter.index', $parameter->id)->with('success', 'Parameter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Parameter Details';
        $parameter = Parameter::find($id);

        return view('parameter.show', compact('parameter', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Parameter $parameter)
    {
        $title = 'Edit Parameter';
        return view('parameter.edit', compact('parameter', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter $parameter)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:parameters,name,' . $parameter->id . '|string|max:255',
            'status' => 'required'
        ]);

        $parameter->update($input);

        return redirect()->route('parameter.index')
                         ->with('success', 'Parameter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter $parameter)
    {
        $parameter->delete();

        return redirect()->route('parameter.index')
                         ->with('success', 'Parameter deleted successfully.');
    }

    public function list()
    {
        $data = Parameter::all();

        return DataTables::of($data)

            ->addColumn('logo', function ($row) {
                $logo = $row->logoMedia;
                $imageHtml = '<div style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden;"><img src="' . $logo->file_path . '" alt="' . $logo->file_name . '" style="width: 100%; height: 100%; object-fit: cover;"></div>';
                return $imageHtml;
            })

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
                $action = '<form action="'.route('parameter.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('parameter.edit', [$row]).'"
                       class="btn btn-warning btn-xs">
                        <i class="far fa-edit"></i>
                    </a>
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(\''.$msg.'\')"><i class="far fa-trash-alt"></i></button>
                    
                </div>
                </form>';

                return $action;
            })
        ->rawColumns(['action','logo'])
        ->make(true);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = Category::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($category);
    }

}
