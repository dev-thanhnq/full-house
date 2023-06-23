<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_users = Cache::remember('count_users', 60 * 60, function () {
            $count_users = User::where('role', 2)->count();
            return $count_users;
        });
        $count_products = Cache::remember('count_products', 60 * 60, function () {
            $count_products = Product::count();
            return $count_products;
        });
        $count_orders = Cache::remember('count_orders', 60 * 60, function () {
            $count_orders = Order::count();
            return $count_orders;
        });

        $products = Product::where('total', '<', 10)->orderBy('total', 'ASC')->get();
        $orders = Order::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $order = DB::table('order_product')->get();
        $total = 0;
        foreach ($order as $ord) {
            $total += $ord->total * $ord->price;
        }

        return view('backend.dashboard')->with([
            'count_users' => $count_users,
            'count_products' => $count_products,
            'count_orders' => $count_orders,
            'products' => $products,
            'orders' => $orders,
            'total' => $total
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function test()
    {
//        Storage::disk('public')->put('file.txt', 'Contents');
//        Storage::disk('local2')->put('file.txt', 'Contents');
//        $contents = Storage::get('file.txt');
//        $exists = Storage::disk('local')->exists('file.txt');
//        return Storage::download('file.txt');
//        $url = Storage::disk('public')->url('file.txt');
//        Storage::copy('file.txt', 'new/file1.txt');
//        Storage::move('file3.txt', 'new/file2.txt');
        Storage::delete(['new/file1.txt', 'new/file2.txt']);
//        dd($url);
    }

    public function customer()
    {
        $user = User::where('role', 2)->paginate(15);
        return view('backend.users.customer')->with(['users' => $user]);
    }

    public function incompetent()
    {
        return view('backend.includes.incompetent');
    }

    public function statistics30()
    {
        $startDate = Carbon::now('Asia/Ho_Chi_Minh')->subDay(30);
        $endDate = Carbon::now('Asia/Ho_Chi_Minh');
        $monthOrderItem = DB::table('order_product')->whereBetween('created_at', [$startDate, $endDate])->get();
        $monthOrder= Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $monthMoney = 0;
        $monthProduct = 0;
        foreach ($monthOrderItem as $order) {
            $monthProduct += $order->total;
            $monthMoney += $order->total * $order->price;
        }

        return view('backend.statistics.index')->with([
            'monthOrder' => $monthOrder,
            'monthMoney' => $monthMoney,
            'monthProduct' => $monthProduct
        ]);
    }

    public function statistics7()
    {
        $startDate = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7);
        $endDate = Carbon::now('Asia/Ho_Chi_Minh');
        $monthOrderItem = DB::table('order_product')->whereBetween('created_at', [$startDate, $endDate])->get();
        $monthOrder= Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $monthMoney = 0;
        $monthProduct = 0;
        foreach ($monthOrderItem as $order) {
            $monthProduct += $order->total;
            $monthMoney += $order->total * $order->price;
        }

        return view('backend.statistics.index')->with([
            'monthOrder' => $monthOrder,
            'monthMoney' => $monthMoney,
            'monthProduct' => $monthProduct
        ]);
    }
}
