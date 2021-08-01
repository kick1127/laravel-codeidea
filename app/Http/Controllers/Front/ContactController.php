<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;

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
        //     'phone' => 'required',
        //     'description' => 'required',
        //     'file' => 'required',
        // ]);
        
        $name = $request->uploadFile;
        Log::channel('stderr')->info('----------------------------------------------in file: '.$name);    
                
        // if ($request->hasFile('file') && $request->file('file')->isValid()) {
        //     $path = $request->file('file')->path();
        //     Log::channel('stderr')->info('----------------------------------------------in file: '.$path);            
        //     // $file_path = $request->file('file')->storeAs('documents', $request);
        // } else {
        //     Log::channel('stderr')->info('----------------------------------------------no file');            
        // }

        // $user = User::create([
        //     'username' => $request->username,
        //     'name'     => $request->name,
        //     'email'    => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->back()->with(session()->flash('success', 'Your request is transfered successfully!'));
    }
}
