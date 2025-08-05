<?php

namespace Modules\Flights\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        PDF::setBinary('/root/.nix-profile/bin/wkhtmltopdf');

        Log::info('GenerateFlightReport job started', [
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'user_id' => $this->userId,
        ]);

        $flights = Flight::whereBetween('date', [$this->startDate, $this->endDate])
            ->orderBy('date', 'DESC')
            ->orderBy('end_time', 'DESC')
            ->with(['user', 'submittedModel'])
            ->get();

        Log::info('Flights fetched', ['count' => $flights->count()]);

        $pdf = PDF::loadView('flights::pages.reports.pdf_flight_report', [
            'flights'    => $flights,
            'start_date' => date('d-m-Y', strtotime($this->startDate)),
            'end_date'   => date('d-m-Y', strtotime($this->endDate)),
        ]);

        $fileName = 'vluchten_' . date('d-m-Y', strtotime($this->startDate)) . '-' . date('d-m-Y', strtotime($this->endDate)) . '.pdf';
        $filePath = 'reports/' . $fileName;

        Storage::disk('local')->put($filePath, $pdf->download()->getOriginalContent());

        Log::info('PDF stored', ['file_path' => $filePath]);

        $user = User::find($this->userId);

        if (!$user) {
            Log::error('User not found with ID ' . $this->userId);
            return;
        }

        FlightReport::create([
            'made_by'           => $user->name,
            'date'              => now()->toDateString(),
            'report_start_date' => $this->startDate,
            'report_end_date'   => $this->endDate,
            'file'              => $fileName,
        ]);

        Log::info('FlightReport record created', [
            'made_by' => $user->name,
            'file' => $fileName,
        ]);

        $user->notify(new FinishedGeneratingFlightReportNotification([
            'title'    => 'Vlucht report is aangemaakt!',
            'subtitle' => 'Report van ' . $this->startDate . ' tot ' . $this->endDate,
            'url'      => route('flights-report.index'),
        ]));

        Log::info('Notification sent to user ID ' . $this->userId);

        Log::info('GenerateFlightReport job finished successfully');
    }
}
