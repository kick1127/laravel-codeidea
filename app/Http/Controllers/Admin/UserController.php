<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.register', [
            'title' => 'Register',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'username' => $request->username,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'type'     => 'admin',
        ]);

        event(new Registered($user));

        return redirect(route('admin.index'));
    }

    public function show(Request $request)
    {
        $user = User::find($request->user()->id);

        return view('admin.user.form', [
            'title'       => 'My Info',
            'currentMenu' => 'my-info',
        ]);
    }

    public function update(Request $request)
    {

    }

    public function password()
    {
        return view('admin.user.password', [
            'title'       => 'My Info',
            'currentMenu' => 'my-info',
        ]);
    }

    public function updatePassword(Request $request)
    {
        $password             = $request->post('password', false);
        $new_password         = $request->post('new_password', false);
        $new_password_confirm = $request->post('new_password_confirm', false);

        if ($password === false) {
            return back()->withErrors('기존 비빌번호를 입력해 주세요.');
        }

        if ($new_password !== false && $new_password !== $new_password_confirm) {
            return back()->withErrors('새 비밀번호가 일치하지 않습니다.');
        }

        $user = User::find($request->user()->id);

        if (!Hash::check($password, $user->password)) {
            return back()->withErrors('기존 비밀번호가 틀렸습니다.');
        }

        $user->update(['password' => Hash::make($new_password)]);

        return redirect(route('admin.password'))->withErrors('비밀번호가 변경되었습니다.');
    }
}
