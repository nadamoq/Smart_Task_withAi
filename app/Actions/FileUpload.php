<?php

namespace App\actions;

use Illuminate\Http\Request;

class FileUpload
{
    public function __construct(public Request $request) {
        
    }
    public  function upload($file, $path = '/', $disk = 'public')
    {
        
        if($this->request->hasFile($file)) {
            $file = $this->request->file($file);
            $file_name=random_int(0,999999).$file->getClientOriginalName();
        } else {
            return null; 
        }
        return $file->storeAs($path,$file_name, $disk);
    }
}