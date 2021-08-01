<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,xlsx,doc,docx,ppt,pptx,pdf,jpg,jpeg,png,gif|max:2048',
        ]);

        $filename = Str::uuid()->toString().'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->storeAs('uploads', $filename);

        return response()->json([
            'original_name' => $request->file('file')->getClientOriginalName(),
            'filename'      => $filename,
            'mime_type'     => $request->file('file')->getClientMimeType(),
            'size'          => $request->file('file')->getSize(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
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
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function download($originalName, $filename, $mimeType): Response
    {
        $originalName = base64_decode($originalName);
        $filename     = base64_decode($filename);
        $mimeType     = base64_decode($mimeType);

        $file = Storage::disk('local')->get('uploads/'.$filename);

        return (new Response($file, 200))->withHeaders([
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'attachment; filename='.$originalName,
        ]);
    }
}
