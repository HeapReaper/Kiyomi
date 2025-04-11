<?php

namespace Modules\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        return view('media::index', [
            'files' => Storage::disk('minio')->allFiles(),
        ]);
    }

    public function create()
    {
        return view('media::create');
    }

    public function store(Request $request) {}

    public function show($id)
    {
        return view('media::show');
    }

    public function edit($id)
    {
        return view('media::edit');
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
