<?php

namespace Modules\Tests\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function index()
    {
        return view('tests::index');
    }

    public function create()
    {
        return view('tests::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('tests::show');
    }

    public function edit($id)
    {
        return view('tests::edit');
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
