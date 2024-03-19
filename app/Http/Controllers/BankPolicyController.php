<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Bank;
use App\Models\Loan;
use App\Models\BankPolicy;
use App\Models\Category;
use App\Models\BankPolicyCategory;
use App\Models\Parameter;
use App\Models\BankPolicyParameter;
use App\Models\User;
use DataTables;

class BankPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Bank Policies';

    public function index()
    {
        $title = self::TITLE;

        return view('policy.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $title = 'Add New Bank Policy';
        $loans = Loan::where('status', 1)
            ->pluck('name', 'id')
            ->prepend('Select Loan Type', '');
        $banks = Bank::where('status', 1)
            ->pluck('name', 'id')
            ->prepend('Select Bank', '');
        $categories = Category::where('status', 1)
            ->pluck('name', 'id');
        $parameters = Parameter::where('status', 1)
            ->pluck('name', 'id')
            ->prepend('Select Parameter', '');
        return view('policy.create', compact('title','loans','banks','categories','parameters'));
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
            'bank_id' => 'required',
            'loan_id' => 'required',
            'policy' => 'required',
            'status' => 'required'
        ]);
        $bankpolicy = BankPolicy::create([
            'bank_id' => $input['bank_id'],
            'loan_id' => $input['loan_id'],
            'policy' => $input['policy'],
            'status' => $input['status'],
        ]);
        foreach ($input['category_id'] as $key => $value) {
            BankPolicyCategory::create([
                'bank_policy_id'=> $bankpolicy->id,
                'category_id' => $input['category_id'][$key],
                'status' =>1
            ]);
        }
        foreach ($input['parameter_id'] as $key => $value) {
            BankPolicyParameter::create([
                'bank_policy_id'=> $bankpolicy->id,
                'parameter_id' => $input['parameter_id'][$key],
                'start' => $input['start'][$key],
                'end' => $input['end'][$key],
                'status' =>1
            ]);
        }

        return redirect()->route('policies.index', $bankpolicy->id)->with('success', 'Bank Policy created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Bank Setting Details';
        $banksetting = Banksetting::find($id);

        return view('banksetting.show', compact('banksetting', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BankPolicy $bankpolicy)
    {
        $title = 'Edit Policy';
        $bankpolicy = BankPolicy::all();
        return view('bankpolicy.edit', compact('bankpolicy', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankPolicy $bankpolicy)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'bank_id' => 'required',
            'loan_id' => 'required',
            'policy' => 'required',
            'status' => 'required'
        ]);

        $bankpolicy->update($input);

        return redirect()->route('policies.index')
                         ->with('success', 'Bank Policy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankPolicy $bankpolicy)
    {
        $bankpolicy->delete();

        return redirect()->route('policies.index')
                         ->with('success', 'Bank Policy deleted successfully.');
    }

    public function list()
    {
        $data = BankPolicy::with('bank','loan','policyMedia')->where('status',1)->get();

        return DataTables::of($data)

            ->addColumn('bank', function ($row) {
                $bank = $row->bank->name;

                return $bank;
            })

            ->addColumn('loan', function ($row) {
                $loan = $row->loan->name;

                return $loan;
            })

            ->addColumn('policy', function ($row) {
                $imageHtml = '<a href="' . $row->policyMedia->file_path . '" alt="' . $row->policyMedia->file_name . '">Policy</a>';

                return $imageHtml;
            })

            ->addColumn('status', function ($row) {
                $status = (($row->status == 1) ? 'Active' : 'Inactive');

                return $status;
            })
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '<form action="'.route('policies.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('policies.edit', [$row]).'"
                       class="btn btn-warning btn-xs">
                        <i class="far fa-edit"></i>
                    </a>
                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(\''.$msg.'\')"><i class="far fa-trash-alt"></i></button>
                    
                </div>
                </form>';

                return $action;
            })
        ->rawColumns(['action','policy'])
        ->make(true);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $documents = Document::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($documents);
    }

}
