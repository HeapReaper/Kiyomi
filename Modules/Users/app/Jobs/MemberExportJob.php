<?php

namespace Modules\Users\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Users\Models\User;

class MemberExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $includedRoles;
    public $requestedBy;

    public function __construct(array $includedRoles, int $requestedBy)
    {
        $this->includedRoles = $includedRoles;
        $this->requestedBy = $requestedBy;
    }

    public function handle()
    {
        $requestingUser = User::find($this->requestedBy);

        $users = User::with(['roles', 'licences'])
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', $this->includedRoles);
            })
            ->get();

        $filename = 'leden_export_' . now()->format('d-m-Y_His') . '.pdf';

        $pdf = Pdf::loadView('users::pages.users_export_pdf', [
            'users'          => $users,
            'included_roles' => $this->includedRoles,
        ])->setPaper('a4', 'landscape');

        Storage::disk('local')->put('user_exports/' . $filename, $pdf->download()->getOriginalContent());

        UserExport::create([
            'file_name' => $filename,
            'made_on'   => now()->format('Y-m-d'),
            'made_by'   => $requestingUser->name,
        ]);
    }
}
