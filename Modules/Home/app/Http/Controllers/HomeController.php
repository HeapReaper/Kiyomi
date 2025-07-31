<?php

namespace Modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home::pages.index');
    }
	
    public function create()
    {
        return view('home::create');
    }
	
    public function store(Request $request)
    {
        //
    }
	
    public function show($id)
    {
        return view('home::show');
    }
	
    public function edit($id)
    {
        return view('home::edit');
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
