<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index(Request $request)
    {
        $terms = Terms::whereNotNull('id');

        $builder = getSearchBuilder($request, $terms);
        if (gettype($builder) === 'string') {
            return back()->withErrors($builder)->withInput($request->input());
        }
        $terms  = $builder['builder'];
        $search = $builder['search'];

        $terms = $terms->paginate(10);
        $terms->appends($search);

        return view('admin.terms.list', [
            'title'       => '약관관리',
            'currentMenu' => 'terms',
            'data'        => $terms,
            'search'      => json_encode($search),
        ]);
    }

    public function create()
    {
        return view('admin.terms.form', [
            'title'       => '약관관리',
            'currentMenu' => 'terms',
        ]);
    }

    public function store(Request $request)
    {
        $path    = $request->post('path', '');
        $title   = $request->post('title', '');
        $content = $request->post('content', '');

        if (empty($path)) {
            return back()->withErrors('경로를 입력해주세요.')->withInput($request->input());
        }
        if (empty($title)) {
            return back()->withErrors('약관명을 입력해주세요.')->withInput($request->input());
        }
        if (empty($content)) {
            return back()->withErrors('내용을 입력해주세요.')->withInput($request->input());
        }
        if (!validatePath($path)) {
            return back()->withErrors('경로는 시작은 영문, 끝은 숫자 포함, 중간은 -, _ 포함하여 이용 가능합니다.')->withInput($request->input());
        }

        $terms          = new Terms();
        $terms->path    = $path;
        $terms->title   = $title;
        $terms->content = $content;
        $terms->save();

        return redirect(route('admin.terms.show', $terms->id));
    }

    public function show($id)
    {
        $terms = Terms::find($id);

        return view('admin.terms.form', [
            'title'       => '약관관리',
            'currentMenu' => 'terms',
            'data'        => $terms,
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

    public function update(Request $request, $id)
    {
        $path    = $request->post('path', '');
        $title   = $request->post('title', '');
        $content = $request->post('content', '');

        if (empty($path)) {
            return back()->withErrors('경로를 입력해주세요.')->withInput($request->input());
        }
        if (empty($title)) {
            return back()->withErrors('약관명을 입력해주세요.')->withInput($request->input());
        }
        if (empty($content)) {
            return back()->withErrors('내용을 입력해주세요.')->withInput($request->input());
        }
        if (!validatePath($path)) {
            return back()->withErrors('경로는 시작은 영문, 끝은 숫자 포함, 중간은 -, _ 포함하여 이용 가능합니다.')->withInput($request->input());
        }

        $terms          = Terms::find($id);
        $terms->path    = $path;
        $terms->title   = $title;
        $terms->content = $content;
        $terms->save();

        return redirect(route('admin.terms.show', $terms->id));
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
}
