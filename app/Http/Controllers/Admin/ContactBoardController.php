<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class ContactBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contact = DB::table('contact')->paginate(10);
        // $members = User::whereNotNull('id')->where('type', 'admin');

        // $builder = getSearchBuilder($request, $contact, ['id'],
        //     ['join_date' => 'created_at', 'last_login_date' => 'last_login_at']);
        // if (gettype($builder) === 'string') {
        //     return back()->withErrors($builder)->withInput($request->input());
        // }
        // $values = $builder['builder'];
        // $search  = $builder['search'];

        // $members = $members->paginate(10);
        // $members->appends($search);
        
        // $values->appends($search);

        // foreach ($contact as $v)
        //     Log::channel('stderr')->info('----------------------------------------------check controller'.$v->id);

        

        return view('admin.contact.list', [
            'title'       => '고객요청관리',
            'currentMenu' => 'contact-board',
            'data'        => $contact,
            // 'search'      => json_encode($search),
        ]);
        // return request()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.board.form', [
            'title'       => '고객요청관리',
            'currentMenu' => 'contact-board',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    private function transform(string $service)
    {
        // $values = trim($service, ",");
        // foreach($values as $vs){
        //     Log::channel('stderr')->info('----------------------------------------------service: '.$vs);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
