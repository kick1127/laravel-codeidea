<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('front.contact');
    }

    public function store(Request $request)
    {
        
        // $request->validate([
        //     'service' => 'required',
        //     'username' => 'required|string|max:255',
        //     'co_name'     => 'required|string|max:255',
        //     'email'    => 'required|string|email|max:255|unique:users',
        //     // 'phone' => ['required | regex:/^(?:(?:(?:\+|00)212[\s]?(?:[\s]?\(0\)[\s]?)?)|0){1}(?:5[\s.-]?[2-3]|6[\s.-]?[13-9]){1}[0-9]{1}(?:[\s.-]?\d{2}){3}$/|digits:10'],
        //     'description' => 'required',
        // ]);
        $path = $request->file('file')->path();
        Log::channel('stderr')->info('----------------------------------------------in file: '.$path);    
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $path = $request->file('file')->path();
            Log::channel('stderr')->info('----------------------------------------------in file: '.$path);            
            // $file_path = $request->file('file')->storeAs('documents', $request);
        } else {
            Log::channel('stderr')->info('----------------------------------------------no file');            
        }

        // $user = User::create([
        //     'username' => $request->username,
        //     'name'     => $request->name,
        //     'email'    => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // alert("adsf");
        return redirect(route('front.contact'));
    }
}
