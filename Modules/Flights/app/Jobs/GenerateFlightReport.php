<?php

namespace Modules\Flights\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Modules\Flights\Models\{Flight, FlightReport};
use Modules\Users\Models\User;
use App\Notifications\FinishedGeneratingFlightReportNotification;

class GenerateFlightReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $startDate, $endDate, $userId;

    public function __construct($startDate, $endDate, $userId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->userId = $userId;
    }

    public function handle()
    {
        $flights = Flight::whereBetween('date', [$this->startDate, $this->endDate])
            ->orderBy('date', 'DESC')
            ->orderBy('end_time', 'DESC')
            ->with(['user', 'submittedModel'])
            ->get();

        $pdf = PDF::loadView('flights::pages.reports.pdf_flight_report', [
            'flights'    => $flights,
            'start_date' => date('d-m-Y', strtotime($this->startDate)),
            'end_date'   => date('d-m-Y', strtotime($this->endDate)),
        ]);

        $fileName = 'vluchten_' . date('d-m-Y', strtotime($this->startDate)) . '-' . date('d-m-Y', strtotime($this->endDate)) . '.pdf';
        $filePath = 'reports/' . $fileName;

        Storage::disk('local')->put($filePath, $pdf->download()->getOriginalContent());

        $user = User::find($this->userId);

        FlightReport::create([
            'made_by'           => $user?->name ?? 'Onbekend',
            'date'              => now()->toDateString(),
            'report_start_date' => $this->startDate,
            'report_end_date'   => $this->endDate,
            'file'              => $fileName,
        ]);

        if (!$user) {
            \Log::error('User not found with ID ' . $this->userId);
            return;
        }

        $user->notify(new FinishedGeneratingFlightReportNotification([
            'title'    => 'Vlucht report is aangemaakt!',
            'subtitle' => 'Report van ' . $this->startDate . ' tot ' . $this->endDate,
            'url'      => route('flights-report.index'),
        ]));
    }
}
