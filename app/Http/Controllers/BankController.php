<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Bank;
use App\Models\User;
use DataTables;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Banks';

    public function index()
    {
        $title = self::TITLE;

        return view('bank.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $title = 'Add New Bank';
        return view('bank.create', compact('title'));
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
            'name' => 'required|unique:banks|string|max:255',
            'logo' => 'required|integer',
            'status' => 'required'
        ]);

        $bank = Bank::create($input);

        return redirect()->route('banks.index', $bank->id)->with('success', 'Bank created successfully.');
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
        $bank = Bank::find($id);

        return view('bank.show', compact('bank', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        $title = 'Edit Bank';
        return view('bank.edit', compact('bank', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:banks,name,' . $bank->id . '|string|max:255',
            'logo' => 'nullable|integer',
            'status' => 'required'
        ]);

        $bank->update($input);

        return redirect()->route('banks.index')
                         ->with('success', 'Bank updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('banks.index')
                         ->with('success', 'Bank deleted successfully.');
    }

    public function list()
    {
        $data = Bank::all();

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
                $action = '<form action="'.route('banks.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('banks.edit', [$row]).'"
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
        $banks = Bank::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($banks);
    }

}
