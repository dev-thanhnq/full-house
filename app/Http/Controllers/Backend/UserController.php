<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePasswordRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('show-users-list')) {
            $query = User::query();
            $query->where('role', '<>', 2);
            $search = '';
            if ($request->has('q') && strlen($request->input('q')) > 0) {
                $query->where('email', 'LIKE', "%" . $request->input('q') . "%");
                $search = $request->input('q');
            }
            $users = $query->paginate(15);
            return view('backend.users.index')->with([
                'users' => $users,
                'search' => $search
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->password = Hash::make($request->get('password'));
        $user->role = (int)$request->get('role');
        $user->is_protected = 0;

        $user->save();
        Alert::success('Thành công', 'Thêm mới thành công!');
        return redirect()->route('backend.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.users.detail')->with([
            'user' => $user
        ]);
    }

    public function account($id)
    {
        $user = User::find($id);
        return view('backend.users.account')->with([
            'user' => $user
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->save();

        Alert::success('Thành công!', 'Cập nhật thông tin thành công');
        return redirect()->route('backend.user.index', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->is_protected == 0 && $id != Auth::user()->id) {
            $user->delete();

            Alert::success('Thành công!', 'Khóa thành công!');
            return redirect()->route('backend.user.index');
        }

        Alert::error('Thất bại!', 'Khóa không thành công!');
        return redirect()->route('backend.user.index');
    }

    public function change(Request $request)
    {
        return view('backend.users.changePassword');
    }

    public function saveNewPass(StorePasswordRequest $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->password = Hash::make($request->input('newPass'));

        $user->save();

        Alert::success('Thành công!', 'Đổi mật khẩu thành công!');
        return redirect()->route('backend.user.index');
    }

    public function saveResetPass(StorePasswordRequest $request, $id)
    {
        if (\auth()->user()->role == 0) {
            $user = User::find($id);
            $user->password = Hash::make($request->input('newPass'));

            $user->save();

            Alert::success('Thành công!', 'Đổi mật khẩu thành công!');
            return redirect()->route('backend.user.index');
        }
        return redirect()->route('backend.user.index');
    }

    public function reset($id)
    {
        return view('backend.users.changePasswordUser')->with(['id' => $id]);
    }

}
