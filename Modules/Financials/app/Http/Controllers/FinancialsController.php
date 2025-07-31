<?php

namespace Modules\Financials\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialsController extends Controller
{
    public function index()
    {
        return view('financials::financials.index');
    }
	
    public function create()
    {
        return view('financials::create');
    }
	
    public function store(Request $request)
    {
        //
    }
	
    public function show($id)
    {
        return view('financials::show');
    }
	
    public function edit($id)
    {
        return view('financials::edit');
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
