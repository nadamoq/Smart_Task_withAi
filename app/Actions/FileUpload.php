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
        } else {
            return null; 
        }
        return $file->store($path, $disk);
    }
}