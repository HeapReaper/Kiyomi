<?php

namespace Modules\Logging\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\logs;

class LoggingController extends Controller
{
    public function index()
    {
        return view('logging::pages.index');
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

    public function purge(): \Illuminate\Http\RedirectResponse
    {
        Logs::purgeLogs();
        return redirect()->back();
    }
}
