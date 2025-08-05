<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications\FinishedGeneratingFlightReportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Flights\Jobs\GenerateFlightReport;
use Modules\Flights\Models\FlightReport;
use Modules\Users\Models\User;

class FlightsReportController extends Controller
{
    public function index()
    {
        return view('flights::pages.reports.index');
    }
	
    public function create()
    {
        return view('flights::create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => ['date', 'required'],
            'end_date' => ['date', 'required'],
        ]);

        GenerateFlightReport::dispatch(
            $validated['start_date'],
            $validated['end_date'],
            Auth::id()
        );

        return redirect()->back()->with('success', 'Vlucht report wordt gegenereerd. Even geduld aub...');
    }

    public function show($id)
    {
        return view('flights::show');
    }
	
    public function edit($id)
    {
        return view('flights::edit');
    }
	
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(int $id)
    {
        $flightReport = FlightReport::find($id);

        if (!$flightReport) {
            return redirect()->back()->with('error', 'Flight report niet gevonden.');
        }

        Storage::disk('local')->delete('/reports/' . $flightReport->file);
        $flightReport->delete();

        return redirect()->back()->with('success', 'Rapport is verwijderd.');
    }
	
    public function download(string $report)
    {
        try {
			session()->flash('success', 'Downloaden voltooid!');
			return Storage::disk('local')->download('/reports/' . $report);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Flight rapport niet gevonden.');
        }
    }
}
