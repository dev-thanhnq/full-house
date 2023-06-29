<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ExportFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Attribute;
use App\Models\Author;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Publishing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use mysql_xdevapi\Exception;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::query();
        $search = '';
        if ($request->has('q') && strlen($request->input('q')) > 0) {
            $query->where('name', 'LIKE', "%" . $request->input('q') . "%");
            $search = $request->input('q');
        }
        $products = $query->orderBy('created_at', 'DESC')->paginate(15);
        return view('backend.products.index')->with([
            'products' => $products,
            'search' => $search,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $product = new Product();
        if ($user->can('create', $product)) {
            $categories = Category::get();
            $authors = Author::get();
            $publishings = Publishing::get();
            return view('backend.products.create')->with([
                'categories' => $categories,
                'authors' => $authors,
                'publishings' => $publishings
            ]);
        } else {
            return view('backend.includes.incompetent');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $origin_price = str_replace(',', '', $request->get('origin_price'));
        $product = new Product();
        $product->name = $request->get('name');
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $request->get('category_id');
        $product->author_id = $request->get('author_id');
        $product->publishing_company_id = $request->get('publishing_company_id');
        $product->sale_price = (int)str_replace(',', '', $request->get('sale_price'));
        $product->content = $request->get('content');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = Storage::disk('public')->putFileAs('images', $image, $image->getClientOriginalName());
            $product->image = $path;
        }
        $product->status = $request->get('status');
        $product->pages_count = '0';
        $product->total = ($request->get('attribute_total_1') ?? 0) + ($request->get('attribute_total_2') ?? 0) + ($request->get('attribute_total_3') ?? 0);
        $product->status = $request->get('status');
        $product->user_id = Auth::user()->id;
        $product->save();
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $path = Storage::disk('public')
                    ->putFileAs('images', $file, $file->getClientOriginalName());
                $image = new Image();
                $image->name = $file->getClientOriginalName();
                $image->path = $path;
                $image->product_id = $product->id;
                $image->save();
            }
        }
        // size 1
        $attribute = new Attribute();
        $attribute->product_id = $product->id;
        $attribute->name = $request->get('attribute_name_1');
        $attribute->price = (int)str_replace(',', '', $request->get('attribute_price_1'));
        $attribute->total = $request->get('attribute_total_1');
        $attribute->save();
        // size 2
        if ($request->has('attribute_name_2') && $request->get('attribute_name_3')) {
            $attribute = new Attribute();
            $attribute->product_id = $product->id;
            $attribute->name = $request->get('attribute_name_2');
            $attribute->price = (int)str_replace(',', '', $request->get('attribute_price_2'));
            $attribute->total = $request->get('attribute_total_2');
            $attribute->save();
        }
        // size 3
        if ($request->has('attribute_name_3') && $request->get('attribute_name_3')) {
            $attribute = new Attribute();
            $attribute->product_id = $product->id;
            $attribute->name = $request->get('attribute_name_3');
            $attribute->price = (int)str_replace(',', '', $request->get('attribute_price_3'));
            $attribute->total = $request->get('attribute_total_3');
            $attribute->save();
        }
        Alert::success('Thành công', 'Cập nhật thành công!');

        return redirect()->route('backend.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $product = Product::find($id);
        if ($user->can('view', $product)) {
            return view('backend.products.detail')->with([
                'product' => $product
            ]);
        } else {
            return view('backend.includes.incompetent');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $user = Auth::user();
        if ($user->can('update', $product)) {
            $categories = Category::get();
            $authors = Author::get();
            $publishings = Publishing::get();
            return view('backend.products.edit')->with([
                'product' => $product,
                'categories' => $categories,
                'authors' => $authors,
                'publishings' => $publishings
            ]);
        } else {
            return view('backend.includes.incompetent');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $product->category_id = $request->get('category_id');
        $product->author_id = $request->get('author_id');
        $product->publishing_company_id = $request->get('publishing_company_id');
        $product->total = $request->get('total');
        $product->content = $request->get('content');
        $product->status = $request->get('status');
        $product->save();
        $publishing = Publishing::find($request->get('publishing_company_id'));
        if ($publishing) {
            $publishing->products_count += 1;
            $publishing->save();
        }
        $author = Author::find($request->get('author_id'));
        if ($author) {
            $author->products_count += 1;
            $author->save();
        }


        Alert::success('Thành công', 'Cập nhật thành công!');
        return redirect()->route('backend.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('backend.product.only-trashed');
    }

    public function hardDelete($id)
    {
        $user = Auth::user();
        $product = Product::onlyTrashed()->find($id);;
        if ($user->can('delete', $product)) {
            $product->forceDelete();
            return back();
        } else {
            Alert::error('Thất bại!', 'Bạn không có quyền thực hiện thao tác này!');
            return back();
        }
    }

    public function onlyTrashed()
    {
        $products = Product::onlyTrashed()->paginate(15);
        return view('backend.products.onlyTrashed')->with([
            'products' => $products
        ]);
    }

    public function restore($id)
    {
        $products = Product::withTrashed()->find($id)->restore();
        return back();
    }

    public function export()
    {
        $products = Product::all();

        return Excel::download(new ExportFile($products), 'Danh sách sản phẩm.xlsx');
    }
}
