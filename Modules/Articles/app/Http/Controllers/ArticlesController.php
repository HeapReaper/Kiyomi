<?php

namespace Modules\Articles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('articles::pages.index');
    }

    public function create()
    {
        return view('articles::pages.create');
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
        return view('articles::pages.edit');
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
