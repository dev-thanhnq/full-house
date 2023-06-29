<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        $categories = Category::all();

        return view('frontend.products')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('frontend.productpage')->with([
            'product' => $product
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function author($id)
    {
        $products = Product::where('author_id', $id)->paginate(12);
        return view('frontend.products')->with([
            'products' => $products
        ]);
    }

    public function category($id)
    {
        $products = Product::where('category_id', $id)->paginate(12);
        $categories = Category::all();
        return view('frontend.products')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function hot()
    {
        $products = Product::orderBy('sold', 'DESC')->paginate(12);
        $categories = Category::all();
        return view('frontend.products')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function sale()
    {
        $products = Product::where('discount_percent', '>', 0)->orderBy('sold', 'DESC')->paginate(12);
        $categories = Category::all();
        return view('frontend.products')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function new()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        $categories = Category::all();
        return view('frontend.products')->with([
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function publishing($id)
    {
        $products = Product::where('publishing_company_id', $id)->orderBy('sold', 'DESC')->paginate(12);
        return view('frontend.products')->with([
            'products' => $products
        ]);
    }

    public function search(Request $request)
    {
        $query = Product::query();
        if ($request->has('keyword') && strlen($request->input('keyword')) > 0) {
            $query->where('name', 'LIKE', '%' . $request->input('keyword') . '%')
                ->orderBy('sold', 'DESC');
        }
        if ($request->has('price') && strlen($request->input('price')) > 0) {
            if ($request->input('price') === '1-1000000') {
                $query->whereBetween('sale_price', [0, 1000000])
                    ->orderBy('sold', 'DESC');
            } elseif ($request->input('price') === '1000000-5000000') {
                $query->whereBetween('sale_price', [1000000, 5000000])
                    ->orderBy('sold', 'DESC');
            } elseif ($request->input('price') === '5000000-10000000') {
                $query->whereBetween('sale_price', [5000000, 10000000])
                    ->orderBy('sold', 'DESC');
            } elseif ($request->input('price') === '10000000') {
                $query->where('sale_price', '>', '10000000')
                    ->orderBy('sold', 'DESC');
            }
        }
        $products = $query->paginate(12);
        $categories = Category::all();
        return view('frontend.products')->with([
            'products' => $products,
            'categories' => $categories,
            'price' => $request->get('price') ?? null
        ]);
    }
}
