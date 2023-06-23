<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::content();
        return view('frontend.cart.list')->with([
            'items' => $items
        ]);
    }
    public function add(Request $request)
    {
        $productAttribute = Attribute::find($request->get('attribute_id'));
        Cart::add($productAttribute->id, $productAttribute->product->name, 1, $productAttribute->price ?? 0, 0, [
            'image' => $productAttribute->product->image,
            'discount_percent' => $product->discount_percent ?? 0,
            'origin_price' => $product->origin_price ?? 0,
            'total' => $productAttribute->total ?? 0,
        ]);
        return redirect()->route('frontend.cart.index');
    }

    public function update(Request $data, $id)
    {
        try {
            $success =  Cart::update($id, $data->qty);
            if ($success) {
                return response()->json([
                    'error'=>false,
                    'message'=>"Cập nhật thành công!",
                ]);
            }
        }catch (\Exception $exception){
            $message = "Cập nhật không thành công";
            return response()->json([
            'error'=>true,
            'message'=>$exception->getMessage(),
            ]);
        }
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('frontend.cart.index');
    }

    public function checkout()
    {
        $items = Cart::content();
        return view('frontend.checkout')->with([
            'items' => $items
        ]);
    }
}
