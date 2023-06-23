<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Version;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Category::query();
        $search = '';
        if ($request->has('q') && strlen($request->input('q')) > 0) {
            $query->where('name', 'LIKE', "%" . $request->input('q') . "%");
            $search = $request->input('q');
        }
        $categories = $query->paginate(15);
        return view('backend.categories.index')->with([
            'categories' => $categories,
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.categories.create')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $category->parent_id = $request->get('parent_id');
        $category->depth = 1;
        $category->save();
        Alert::success('Thành công', 'Thêm mới thành công!');
        return redirect()->route('backend.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category_edit = Category::find($id);
        $categories = Category::get();
        return view('backend.categories.edit')->with([
            'categories' => $categories,
            'category_edit' => $category_edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_edit = Category::find($id);
        $categories = Category::get();
        return view('backend.categories.edit')->with([
            'categories' => $categories,
            'category_edit' => $category_edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $category->parent_id = $request->get('parent_id');
        $category->depth = 1;
        $category->save();

        Alert::success('Thành công', 'Cập nhật thành công!');
        return redirect()->route('backend.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('backend.category.index');
    }

    public function showProducts($category_id)
    {
        $category = Category::find($category_id);
        $products = $category->products;
        return view('backend.products.productscategory')->with([
            'products' => $products,
            'categoryName' => $category->name
        ]);
    }
}
