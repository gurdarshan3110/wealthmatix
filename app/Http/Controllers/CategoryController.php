<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const TITLE = 'Categories';

    public function index()
    {
        $title = self::TITLE;

        return view('category.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $title = 'Add New Category';
        return view('category.create', compact('title'));
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
            'name' => 'required|unique:categories|string|max:255',
            'status' => 'required'
        ]);

        $category = Category::create($input);

        return redirect()->route('category.index', $category->id)->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'View Category Details';
        $Category = Category::find($id);

        return view('Category.show', compact('Category', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title = 'Edit Category';
        return view('category.edit', compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|string|max:255',
            'status' => 'required'
        ]);

        $category->update($input);

        return redirect()->route('categories.index')
                         ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')
                         ->with('success', 'Category deleted successfully.');
    }

    public function list()
    {
        $data = Category::all();

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
                $action = '<form action="'.route('category.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('category.edit', [$row]).'"
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
