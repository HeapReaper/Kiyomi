<?php

namespace Modules\Memberships\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MembershipsController extends Controller
{
    public function index()
    {
        return view('memberships::index');
    }

    public function create()
    {
        return view('memberships::create');
    }

    public function store(Request $request) {}

    public function show($id)
    {
        return view('memberships::show');
    }

    public function edit($id)
    {
        return view('memberships::edit');
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
