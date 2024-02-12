<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Supplier;
use App\Models\UserSupplier;
use App\Models\User;
use DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    const TITLE = 'Loans';

    public function index()
    {
        $title = self::TITLE;

        return view('suppliers.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add New Loans Type';
        return view('suppliers.create', compact('title'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_no' => ['required', 'regex:/^(\+\d{1,3}[- ]?)?\d{10,}$/', 'unique:employees'],
            'status' => 'required'
        ]);

        $autoGeneratedPassword = '12345678';

        $supplier = Supplier::create($input);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($autoGeneratedPassword),
            'user_type' => User::USER_SUPPLIER,
        ]);
        $user->suppliers()->attach($supplier);

        return redirect()->route('suppliers.index', $supplier->id)->with('success', 'Supplier created successfully.');
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
        $supplier = Supplier::find($id);

        return view('suppliers.show', compact('supplier', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $title = 'Edit Loan Type';

        return view('suppliers.edit', compact('supplier', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $input = $request->all();
        $user = User::where('email', $supplier->email)->first();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,id,'.$user->id,
            'phone_no' => [
                'required',
                'regex:/^(\+\d{1,3}[- ]?)?\d{10,}$/',
                'unique:suppliers,phone_no,'.$supplier->id.',id'
            ],
            'status' => 'required',
        ]);
        $supplier->update($input);
        $user->update(['name' => $request->name,
            'email' => $request->email]);

        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')
                         ->with('success', 'Supplier deleted successfully.');
    }

    public function list()
    {
        $data = Supplier::get();

        return DataTables::of($data)


            ->addColumn('name', function ($row) {
                $name = $row->name;

                return $name;
            })

            ->addColumn('email', function ($row) {
                $email = $row->email;

                return $email;
            })

            ->addColumn('phone_no', function ($row) {
                $phone_no = $row->phone_no;

                return $phone_no;
            })

            ->addColumn('address', function ($row) {
                $address = $row->address;

                return $address;
            })

            ->addColumn('status', function ($row) {
                $status = (($row->status == 1) ? 'Active' : 'Inactive');

                return $status;
            })
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '<form action="'.route('suppliers.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('suppliers.edit', [$row]).'"
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
        $suppliers = Supplier::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($suppliers);
    }

}