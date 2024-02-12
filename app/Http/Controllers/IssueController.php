<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Inventory;
use App\Models\Bill;
use App\Models\VariantBill;
use App\Models\User;
use DataTables;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Issue Items';

    public function index()
    {
        $title = self::TITLE;

        return view('issueitem.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Issue New Item';
        return view('issueitem.create', compact('title'));
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
        //dd($input);
        $validator = $request->validate([
            'bill_date' => 'required',
            'transfered_to' => 'required',
            'variant' => 'required|array|min:1', 
        ]);

        $billNo = $this->generateBillNumber();
        $bill = Bill::create([
            'bill_number' => $billNo,
            'transfered_to' => $input['transfered_to'],
            'type' => Bill::INNER_TYPE_VAL,
            'bill_date' => $input['bill_date'],
            'store_id' => session('store_id'),
            'user_id' => Auth::user()->id,
            'status' => $input['status'],
        ]);

        foreach ($input['variant'] as $index => $variant) {
            $bill->variants()->create([
                'bill_id' => $bill->id,
                'batch_no' => $input['batch_no'][$index],
                'manufacture_date' => $input['manufacture_date'][$index],
                'expiry_date' => $input['expiry_date'][$index],
                'variant_id' => $input['variant_id'][$index],
                'quantity' => $input['quantity'][$index],
                'mrp' => $input['mrp'][$index],
                'unit_price' => $input['unit_price'][$index],
                'sale_price' => $input['sale_price'][$index],
                'status' => 1, 
            ]);
        }

        foreach ($input['variant'] as $index => $variant) {
            Inventory::create([
                'batch_no' => $input['batch_no'][$index],
                'manufacture_date' => $input['manufacture_date'][$index],
                'expiry_date' => $input['expiry_date'][$index],
                'variant_id' => $input['variant_id'][$index],
                'quantity' => -$input['quantity'][$index],
                'mrp' => $input['mrp'][$index],
                'unit_price' => $input['unit_price'][$index],
                'sale_price' => $input['sale_price'][$index],
                'store_id' => session('store_id'),
                'type' => Inventory::STOCK_TYPE_ISSUES_VAL,
                'status' => Inventory::STOCK_STATUS_INTRANSIT_VAL, 
            ]);
        }

        return redirect()->route('issue.index', $bill->id)->with('success', 'Bill created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View MRN Details';
        $item = Mrn::find($id);

        return view('mrn.show', compact('mrn', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $title = 'Edit MRN';

        return view('mrn.edit', compact('mrn', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mrn $mrn)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'mrn_date' =>'required',
            'status' => 'required'
        ]);

        $mrn->update($input);

        return redirect()->route('mrn.index')
                         ->with('success', 'MRN updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mrn $mrn)
    {
        $mrn->delete();

        return redirect()->route('mrn.index')
                         ->with('success', 'MRN deleted successfully.');
    }

    public function list()
    {
        $data = Bill::where('store_id',session('store_id'))->where('type',Bill::INNER_TYPE_VAL)->get();
        //dd($data);
        return DataTables::of($data)

            // ->addColumn('image', function ($row) {
            //     $image = '<img src="'.$row->media.'" class="item-image"/>';

            //     return $image;
            // })

            ->addColumn('bill_number', function ($row) {
                $bill_number = $row->bill_number;

                return $bill_number;
            })

            ->addColumn('bill_date', function ($row) {
                $bill_date = $row->bill_date;

                return $bill_date;
            })


            ->addColumn('status', function ($row) {
                $status = (($row->status == 1) ? 'Active' : 'Inactive');

                return $status;
            })
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '<form action="'.route('mrn.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('mrn.show', [$row]).'"
                       class="btn btn-primary btn-xs">
                        <i class="far fa-eye"></i>
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

    public function generateBillNumber() {
        $currentMonthYear = date('ym');

        $lastBill = Bill::where('bill_number', 'like', $currentMonthYear . '%')
            ->where('store_id',session('store_id'))
            ->orderBy('bill_number', 'desc')
            ->first();

        $sequenceNumber = ($lastBill) ? ((int) substr($lastBill->bill_number, -4)) + 1 : 1;

        $formattedSequence = str_pad($sequenceNumber, 4, '0', STR_PAD_LEFT);

        $billNumber = $currentMonthYear . '/' . $formattedSequence;

        return $billNumber;
    }

}
