<?php

namespace Modules\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        return view('media::index');
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
