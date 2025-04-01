<?php

namespace Modules\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('articles::index');
    }

    public function create()
    {
        return view('articles::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('articles::show');
    }

    public function edit($id)
    {
        return view('articles::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
