<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Bank;
use App\Models\BankAddress;
use App\Models\User;
use DataTables;

class BankAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Banks Address Book';

    public function index()
    {
        $title = self::TITLE;

        return view('bankaddress.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $title = 'Add New Bank Address';
        $banks = Bank::where('status', 1)
            ->pluck('name', 'id')
            ->prepend('Select Bank', '');
        return view('bankaddress.create', compact('banks','title'));
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
            'bank_id' => 'required|unique:banks|string|max:255',
            'status' => 'required'
        ]);

        $bank = BankAddress::create($input);

        return redirect()->route('addressbook.index', $bank->id)->with('success', 'Address created successfully.');
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
    public function edit(BankAddress $bankaddress)
    {
        $title = 'Edit Address Book';
        return view('bankaddress.edit', compact('bankaddress', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAddress $bankaddress)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'status' => 'required'
        ]);

        $bank->update($input);

        return redirect()->route('addressbook.index')
                         ->with('success', 'Address book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAddress $bankaddress)
    {
        $bankaddress->delete();

        return redirect()->route('addressbook.index')
                         ->with('success', 'Address book deleted successfully.');
    }

    public function list()
    {
        $data = BankAddress::with('bank')->get();

        return DataTables::of($data)

            ->addColumn('bank', function ($row) {
                $bank = $row->bank->name;

                return $bank;
            })

            ->addColumn('city', function ($row) {
                $city = $row->city;

                return $city;
            })

            ->addColumn('sales_manager', function ($row) {
                $sales_manager = $row->sales_manager;

                return $sales_manager;
            })

            ->addColumn('sales_manager_phone', function ($row) {
                $sales_manager_phone = $row->sales_manager_phone;

                return $sales_manager_phone;
            })

            ->addColumn('status', function ($row) {
                $status = (($row->status == 1) ? 'Active' : 'Inactive');

                return $status;
            })
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '<form action="'.route('addressbook.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('addressbook.edit', [$row]).'"
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
