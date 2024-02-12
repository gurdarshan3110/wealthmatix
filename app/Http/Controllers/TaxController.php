<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\TaxDetail;
use App\Models\User;
use DataTables;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Taxes';

    public function index()
    {
        $taxes = TaxDetail::all();

        $title = self::TITLE;

        return view('tax.index', compact('taxes', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add New Tax';

        return view('tax.create', compact('title'));
    }

    /**
     * Tax a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:tax_details|string|max:255',
            'rate' => 'required|numeric|between:0,100',
            'status' => 'required'
        ]);

        $tax = TaxDetail::create($input);

        return redirect()->route('taxes.index', $tax->id)->with('success', 'Tax created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Tax Details';
        $tax = TaxDetail::find($id);

        return view('tax.show', compact('tax', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        $title = 'Edit Tax';

        return view('tax.edit', compact('tax', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxDetail $tax)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:tax_details,name,' . $tax->id . '|string|max:255',
            'rate' => 'required|numeric|between:0,100',
            'status' => 'required'
        ]);

        $tax->update($input);

        return redirect()->route('taxes.index')
                         ->with('success', 'Tax updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxDetail $tax)
    {
        $tax->delete();

        return redirect()->route('taxes.index')
                         ->with('success', 'Tax deleted successfully.');
    }

    public function list()
    {
        $data = TaxDetail::all();

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
                $action = '<form action="'.route('taxes.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('taxes.edit', [$row]).'"
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
        $taxes = TaxDetail::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($taxes);
    }

}
