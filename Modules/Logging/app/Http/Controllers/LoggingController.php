<?php

namespace Modules\Logging\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoggingController extends Controller
{
    public function index()
    {
        return view('logging::index');
    }
	
    public function create()
    {
        return view('logging::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('logging::show');
    }
	
    public function edit($id)
    {
        return view('logging::edit');
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
