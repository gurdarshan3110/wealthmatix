<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Unit;
use App\Models\User;
use DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Loans';

    public function index()
    {
        $units = Unit::all();

        $title = self::TITLE;

        return view('unit.index', compact('units', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add New Loan';

        return view('unit.create', compact('title'));
    }

    /**
     * Unit a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:units|string|max:255',
            'status' => 'required'
        ]);

        $unit = Unit::create($input);

        return redirect()->route('units.index', $unit->id)->with('success', 'Unit created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Loan Details';
        $unit = Unit::find($id);

        return view('unit.show', compact('unit', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $title = 'Edit Loan';

        return view('unit.edit', compact('unit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:units,name,' . $unit->id . '|string|max:255',
            'status' => 'required'
        ]);

        $unit->update($input);

        return redirect()->route('units.index')
                         ->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')
                         ->with('success', 'Unit deleted successfully.');
    }

    public function list()
    {
        $data = Unit::all();

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
                $action = '<form action="'.route('units.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('units.edit', [$row]).'"
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
        $units = Unit::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($units);
    }

}
