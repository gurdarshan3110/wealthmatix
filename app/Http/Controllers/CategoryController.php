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
        $categories = Category::all();

        $title = self::TITLE;

        return view('category.index', compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function generateCategoryOptions($categories, $parent = null, $prefix = '')
    {
        $options = ['Parent Itself'];

        foreach ($categories as $category) {
            if ($category->parent === $parent) {
                $options[$category->id] = $prefix . $category->name;

                // Recursively call the function for child categories
                $options += self::generateCategoryOptions($categories, $category->id, $prefix . '--');
            }
        }

        return $options;
    }

    public function create(Request $request)
    {
        $title = 'Add New Category';
        $categories = Category::all();
        $categoryOptions = $this->generateCategoryOptions($categories);
        return view('category.create', compact('title','categoryOptions'));
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
            'parent' => 'required|integer',
            'status' => 'required'
        ]);

        $category = Category::create($input);

        return redirect()->route('categories.index', $category->id)->with('success', 'Category created successfully.');
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
        $category = Category::find($id);

        return view('category.show', compact('category', 'title'));
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
        $categories = Category::all();
        $categoryOptions = $this->generateCategoryOptions($categories);
        return view('category.edit', compact('category', 'title','categoryOptions'));
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
            'parent' => 'nullable|integer',
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

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }

    public function list()
    {
        $data = Category::all();

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
                $action = '<form action="'.route('categories.destroy', [$row]).'" method="post">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <div class="btn-group">
                    <a href="'.route('categories.edit', [$row]).'"
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
        $categories = Category::where('name', 'LIKE', "%{$query}%")->get(['name','id']);

        return response()->json($categories);
    }

}
