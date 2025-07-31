<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Flights\Models\Flight;
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

		// TODO: Split up try catch
        try {
            $flights = Flight::whereBetween('date', [$validated['start_date'], $validated['end_date']])
                ->orderBy('date', 'DESC')
                ->orderBy('end_time', 'DESC')
                ->with('user')
                ->with('submittedModel')
                ->get();

            $pdf = Pdf::loadView('flights::pages.reports.pdf_flight_report', [
                'flights' => $flights,
                'start_date' => date('d-m-Y', strtotime($validated['start_date'])),
                'end_date' => date('d-m-Y', strtotime($validated['end_date'])),
            ]);
			
			FlightReport::create([
				'made_by' => (User::find(Auth::user()->id)->name),
				'date' => date('Y-m-d'),
				'report_start_date' => $validated['start_date'],
				'report_end_date' => $validated['end_date'],
				'file' => 'vluchten_' . date('d-m-Y', strtotime($validated['start_date'])).'-' . date('d-m-Y', strtotime($validated['end_date'])).'.pdf',
			]);
			
			Storage::disk('local')->put('reports/vluchten_' . date('d-m-Y', strtotime($validated['start_date'])).'-' . date('d-m-Y', strtotime($validated['end_date'])).'.pdf', $pdf->download()->getOriginalContent());
			
            return redirect()->back()->with('success', 'Vlucht report is aangemaakt! Download hem nu...');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error);
        }
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
