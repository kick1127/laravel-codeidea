<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = User::whereNotNull('id')->where('type', 'member');

        $builder = getSearchBuilder($request, $members, ['id'],
            ['join_date' => 'created_at', 'last_login_date' => 'last_login_at']);
        if (gettype($builder) === 'string') {
            return back()->withErrors($builder)->withInput($request->input());
        }
        $members = $builder['builder'];
        $search  = $builder['search'];

        $members = $members->paginate(10);
        $members->appends($search);

        return view('admin.member.list', [
            'title'       => '회원관리',
            'currentMenu' => 'member',
            'data'        => $members,
            'search'      => json_encode($search),
        ]);
    }

    public function create()
    {
        return view('admin.member.create-form', [
            'title'       => '회원관리',
            'currentMenu' => 'member',
        ]);
    }

    public function store(Request $request)
    {
        $username        = $request->post('username', false);
        $password        = $request->post('password', false);
        $passwordConfirm = $request->post('password_confirm', false);
        $name            = $request->post('name', false);
        $email           = $request->post('email', false);
        $cellphone       = $request->post('cellphone', false);
        $birthday        = $request->post('birthday', false);
        $postcode        = $request->post('postcode', false);
        $address         = $request->post('address', false);
        $addressDetail   = $request->post('address_detail', false);
        $streetAddress   = $request->post('street_address', false);

        if ($username === false) {
            return back()->withErrors('아이디를 입력해주세요.')->withInput($request->input());
        }

        $member = new User();

        $member->type     = 'member';
        $member->username = $username;
        $member->code     = $this->getNewCode();

        if ($password !== false && $passwordConfirm !== false) {
            if ($password !== $passwordConfirm) {
                return back()->withErrors('패스워드와 패스워드 확인이 일치하지 않습니다.');
            }
            $member->password = Hash::make($password);
        }
        if ($name !== false) {
            $member->name = $name;
        }
        if ($email !== false) {
            $member->email = $email;
        }
        if ($cellphone !== false) {
            $member->cellphone = $cellphone;
        }
        if ($birthday !== false) {
            $member->birthday = $birthday;
        }
        if ($postcode !== false) {
            $member->postcode = $postcode;
        }
        if ($address !== false) {
            $member->address = $address;
        }
        if ($addressDetail !== false) {
            $member->address_detail        = $addressDetail;
            $member->street_address_detail = $addressDetail;
        }
        if ($streetAddress !== false) {
            $member->street_address = $streetAddress;
        }

        $member->save();

        return response()->redirectTo(route('admin.member.show', $member->code));
    }

    public function show(string $code)
    {
        $member = User::where([
            'type' => 'member',
            'code' => $code,
        ])->first();

        return view('admin.member.edit-form', [
            'title'       => '회원관리',
            'currentMenu' => 'member',
            'data'        => $member,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $code)
    {
        $password        = $request->post('password', false);
        $passwordConfirm = $request->post('password_confirm', false);
        $name            = $request->post('name', false);
        $email           = $request->post('email', false);
        $cellphone       = $request->post('cellphone', false);
        $birthday        = $request->post('birthday', false);
        $postcode        = $request->post('postcode', false);
        $address         = $request->post('address', false);
        $addressDetail   = $request->post('address_detail', false);
        $streetAddress   = $request->post('street_address', false);

        $member = User::where('code', $code)->where('type', 'member')->first();

        if ($password !== false && $passwordConfirm !== false) {
            if ($password !== $passwordConfirm) {
                return back()->withErrors('패스워드와 패스워드 확인이 일치하지 않습니다.');
            }
            $member->password = Hash::make($password);
        }
        if ($name !== false) {
            $member->name = $name;
        }
        if ($email !== false) {
            $member->email = $email;
        }
        if ($cellphone !== false) {
            $member->cellphone = $cellphone;
        }
        if ($birthday !== false) {
            $member->birthday = $birthday;
        }
        if ($postcode !== false) {
            $member->postcode = $postcode;
        }
        if ($address !== false) {
            $member->address = $address;
        }
        if ($addressDetail !== false) {
            $member->address_detail        = $addressDetail;
            $member->street_address_detail = $addressDetail;
        }
        if ($streetAddress !== false) {
            $member->street_address = $streetAddress;
        }

        $member->save();

        return response()->redirectTo(route('admin.member.show', $member->code));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getNewCode(): ?string
    {
        $loop = true;
        $code = null;

        while ($loop) {
            $code  = generateRandomString();
            $exist = User::where('code', $code)->get();
            if ($exist->count() == 0) {
                $loop = false;
            }
        }

        return $code;
    }
}
