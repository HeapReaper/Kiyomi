<?php

namespace Modules\Payments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        return view('payments::index');
    }

    public function create()
    {
        return view('payments::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('payments::show');
    }

    public function edit($id)
    {
        return view('payments::edit');
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
