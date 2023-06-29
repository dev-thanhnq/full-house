<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', 2)->get();
        return view('backend.orders.index')->with([
            'orders' => $orders
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
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $order->user_id = 0;
        $order->customer_name = $request->name;
        $order->customer_email = $request->email;
        $order->customer_phone = $request->phone;
        $order->customer_address = $request->address;
        $order->shipping_method = (int)$request->shipping_method;
        $order->products_count = Cart::count();
        $order->money = Cart::total();
        $order->status = 1;
        $order->save();
        foreach (Cart::content() as $item) {
            $attribute = Attribute::find($item->id);
            DB::table('order_attribute')->insert([
                'order_id' => $order->id,
                'attribute_id' => $attribute->id,
                'price' => $attribute->price,
                'total' => $item->qty,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
            ]);
            $attribute->total -= $item->qty;
            $attribute->save();
            $product = Product::find($attribute->product_id);
            $product->total -= $item->qty;
            $product->sold += $item->qty;
            $product->save();
        }
        Cart::destroy();
        alert()->success('Đặt hàng thành công!', 'Đơn hàng của bạn sẽ được giao trong thời gian sớm nhất!');

        return redirect()->route('frontend.home.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $prod = DB::table('order_attribute')->where('order_id', $order->id)->get();
        $attributes = collect($prod)->pluck('attribute_id')->toArray();
        $attributes= Attribute::whereIn('id', $attributes)->get();
        foreach ($attributes as $attribute) {
            foreach ($prod as $pro) {
                if ($attribute->id == $pro->attribute_id) {
                    $attribute['total_order'] = $pro->total;
                }
            }
        }
        $user = User::find($order->user_id);
        return view('backend.orders.detail')->with([
            'order' => $order,
            'user' => $user,
            'attributes' => $attributes,
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
        $order = Order::find($id);
        try {
            $success = $order->delete();
            if ($success) {
                return response()->json([
                    'error' => false,
                    'message' => "Xóa nhận thành công!",
                ]);
            }
        } catch (\Exception $exception) {
            $message = "Không thành công!";
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function nonAcceptList()
    {
        $orders = Order::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('backend.orders.nonAccept')->with([
            'orders' => $orders,
        ]);
    }

    public function successList()
    {
        $orders = Order::where('status', 3)->with('products')->get();
        return view('backend.orders.success')->with([
            'orders' => $orders
        ]);
    }

    public function accept($id)
    {
        $order = Order::find($id);
        try {
            $order->status = 2;
            $order->user_id = Auth::user()->id;
            $order->save();
            alert()->success('Duyệt đơn thành công!');

            return redirect()->route('order.nonAccept');
        } catch (\Exception $exception) {
            alert()->error('Duyệt thất bại!');
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function success($id)
    {
        $order = Order::find($id);
        $order->status = 3;
        $order->save();

        alert()->success('Giao hàng thành công!');
        return redirect()->route('order.successList');

    }
}
