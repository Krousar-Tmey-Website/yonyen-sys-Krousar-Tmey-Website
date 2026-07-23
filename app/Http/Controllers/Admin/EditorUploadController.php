<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorUploadController extends Controller
{
    public function image(Request $request)
    {
        $fileKey = $request->hasFile('upload') ? 'upload' : 'image';

        $request->validate([
            $fileKey => ['required', 'image', 'max:5120'],
        ]);

        $path = $request->file($fileKey)->store('editor/images', 'public');

        return response()->json([
            'url' => '/storage/' . $path,
        ]);
    }
}
