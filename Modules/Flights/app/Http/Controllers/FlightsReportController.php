<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Flights\Models\Flight;

class FlightsReportController extends Controller
{
    public function index()
    {
        return view('flights::pages.reports.index', [
            'reports' => array_filter(Storage::allFiles('reports'), function ($item) {
                return strpos($item, '.pdf');
            }),
        ]);
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

            Storage::disk('local')->put('reports/vluchten_'.date('d-m-Y', strtotime($validated['start_date'])).'-'.date('d-m-Y', strtotime($validated['end_date'])).'.pdf', $pdf->download()->getOriginalContent());

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

    public function destroy($id)
    {
        //
    }
	
    public function download(string $report)
    {
        try {
            return Storage::disk('local')->download('/reports/'.$report);
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
