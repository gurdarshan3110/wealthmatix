<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Sub Categories';

    public function index()
    {
        $categories = Category::all();

        $title = self::TITLE;

        return view('subcategory.index', compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = 'Add New Sub Category';

        return view('subcategory.create', compact('title'));
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
            'name' => 'required|unique:subcategories|string|max:255',
            'category_id' => 'required',
            'status' => 'required'
        ]);

        $subcategory = SubCategory::create($input);

        return redirect()->route('subcategories.index', $category->id)->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Sub Category Details';
        $subcategory = SubCategory::find($id);

        return view('subcategory.show', compact('subcategory', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $title = 'Edit Sub Category';

        return view('subcategory.edit', compact('subcategory', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:subcategories,name,' . $subcategory->id . '|string|max:255',
            'category_id' => 'required',
            'status' => 'required'
        ]);

        $subcategory->update($input);

        return redirect()->route('subcategories.index')
                         ->with('success', 'Sub Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('subcategories.index')
                         ->with('success', 'Sub Category deleted successfully.');
    }

    public function list()
    {
        $data = SubCategory::all();

        return DataTables::of($data)

            ->addColumn('name', function ($row) {
                $name = $row->name;

                return $name;
            })

            ->addColumn('category', function ($row) {
                $category = $row->category->name;

                return $category;
            })

            ->addColumn('status', function ($row) {
                $status = (($row->status == 1) ? 'Active' : 'Inactive');

                return $status;
            })
            ->addColumn('action', function ($row) {
                $msg = 'Are you sure?';
                $action = '<form action="'.route('subcategories.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('subcategories.edit', [$row]).'"
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
        $categories = SubCategory::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($categories);
    }

}
