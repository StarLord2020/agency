<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function fileUpload(Request $request){

    if($request->isMethod('post')){

        if($request->hasFile('image')) {
            $file = $request->file('image');
            Storage::disk('local')->put('file.txt', 'Contents');
            $file->move(public_path() . '/path','filename.img');
        }
    }
}
}
