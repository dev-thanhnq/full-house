<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublishingRequest;
use App\Http\Requests\UpdatePublishingRequest;
use App\Models\Publishing;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PublishingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Publishing::query();
        $search = '';
        if ($request->has('q') && strlen($request->input('q')) > 0) {
            $query->where('name', 'LIKE', "%" . $request->input('q') . "%");
            $search = $request->input('q');
        }
        $publishings = $query->paginate(15);
        return view('backend.publishing.index')->with([
            'publishings' => $publishings,
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
        return view('backend.publishing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePublishingRequest $request)
    {
        $publishing = new Publishing();
        $publishing->name = $request->name;
        $publishing->slug = \Illuminate\Support\Str::slug($request->get('name'));
        $publishing->products_count = 0;
        $publishing->save();

        Alert::success('Thành công', 'Thêm mới thành công!');
        return redirect()->route('backend.publishings.index');
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
        $pub = Publishing::find($id);
        return view('backend.publishing.edit')->with([
            'publish' => $pub
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePublishingRequest $request, $id)
    {
        $pub = Publishing::find($id);
        $pub->name = $request->name;
        $pub->save();

        Alert::success('Thành công', 'Cập nhật thành công!');
        return redirect()->route('backend.publishings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pub = Publishing::find($id);
        $pub->delete();
        return redirect()->route('backend.publishings.index');
    }
}
