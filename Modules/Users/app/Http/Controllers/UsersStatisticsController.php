<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersStatisticsController extends Controller
{
    public function index()
    {
        return view('users::pages.statistics');
    }
	
    public function create()
    {
        return view('users::create');
    }
	
    public function store(Request $request)
    {
        //
    }
	
    public function show($id)
    {
        return view('users::show');
    }
	
    public function edit($id)
    {
        return view('users::edit');
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
