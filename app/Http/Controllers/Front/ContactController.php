<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }

    public function store(Request $request)
    {        
        $request->validate([        
            'service' => 'required',
            'username' => 'required|string|max:255',
            'co_name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone' => 'required',
            'description' => 'required|max:3000', //korean 1000 char
            'upload' => 'required',
        ]);
        
        $file = $request->upload;
        $filename = $file->getClientOriginalName();
        // $filepath = $file->path();
        // $fileextension = $file->extension();

        $store_file = $file->storeAs('contact', $filename);
        // Log::channel('stderr')->info('---------------------------------------------- '.$store_file); 
        // foreach($input as $arr) {
            // Log::channel('stderr')->info('----------------------------------------------in file: '.$request->username);    
            // Log::channel('stderr')->info('----------------------------------------------in file: '.$request->co_name);    
            // Log::channel('stderr')->info('----------------------------------------------in file: '.$request->email);    
            // Log::channel('stderr')->info('----------------------------------------------in file: '.$request->phone);    
            // Log::channel('stderr')->info('----------------------------------------------in file: '.$request->service);    
            // Log::channel('stderr')->info('----------------------------------------------in file: '.$request->description);    
        // }

        DB::table('contact')->insert([
            'submitted_at' => now(),
            'username' => $request->username,
            'co_name'  => $request->co_name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'service'  => $request->service,
            'description' => $request->description,
            'file'     => $filename,
        ]);

        return redirect()->back()->with(session()->flash('success', 'Your request is transfered successfully!'));
    }
}
