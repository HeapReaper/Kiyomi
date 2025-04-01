<?php

namespace Modules\SiteView\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index()
    {
        return view('siteview::index');
    }

    public function create()
    {
        return view('siteview::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('siteview::show');
    }

    public function edit($id)
    {
        return view('siteview::edit');
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
