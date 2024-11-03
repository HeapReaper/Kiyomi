<?php

namespace Modules\Flights\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Flights\Models\Flight;
use Spatie\LaravelPdf\Facades\Pdf;

class FlightsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @author AutiCodes
     */
    public function index()
    {
        return view('flights::pages.reports.index', [
            'reports' => array_filter(Storage::allFiles('/reports'), function ($item) {
                            return strpos($item, '.pdf');
                        })
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flights::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @author AutiCodes
     */
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

            Pdf::view('flights::pages.reports.pdf_flight_report', [
                    'flights' => $flights,
                    'start_date' => date('d-m-y', strtotime($validated['start_date'])),
                    'end_date' => date('d-m-y', strtotime($validated['end_date']))
                    ])
                    ->disk('local')
                    ->save('reports/vluchten_' . date('d-m-y', strtotime($validated['start_date'])) . '-' . date('d-m-y', strtotime($validated['end_date'])) . '.pdf');

            return redirect()->back()->with('success', 'Vlucht report is aangemaakt! Download hem nu...');

        } catch (Exceptions $error) {
            return redirect()->back()->with('error', $error);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('flights::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('flights::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Downloads flight report
     *
     * @author AutiCodes
     * @return Redirect
     */
    public function download($report)
    {
        try {
            return Storage::disk('local')->download('/reports/'. $report);
        } catch (Exception $e) {
            abort(404);
        }
    }
}
