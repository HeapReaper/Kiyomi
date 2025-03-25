<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Users\Models\User;
use Modules\Users\Models\UserExport;

class UsersExportController extends Controller
{
    public function index()
    {
        return view('users::pages.users_export');
    }

    public function create()
    {
        return view('users::create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'include_members' => ['required'],
        ]);

        try {
            $users = User::with('roles')->with('licences')->whereHas('roles', function ($query) use ($validated) {
                $query->whereIn('name', $validated['include_members']);
            })->get();

            $pdf = PDF::loadView('users::pages.users_export_pdf', [
                'users'          => $users,
                'included_roles' => $validated['include_members'],
            ])->setPaper('a4', 'landscape');

            Storage::disk('local')->put('user_exports/leden_export_' . date('d-m-Y', ) . '.pdf', $pdf->download()->getOriginalContent());

            UserExport::create([
                'file_name' => 'leden_export_' . date('d-m-Y', ) . '.pdf',
                'made_on'   => date('Y-m-d'),
                'made_by'   => (User::find(Auth::user()->id)->name),
            ]);

            return redirect()->back()->with('success', 'Leden export is aangemaakt! Download hem nu...');
        } catch (\Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    public function show($id)
    {
        return view('users::show');
    }

    public function edit($id)
    {
        return view('users::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(int $id)
    {
        $userReport = UserExport::find($id);

        if (!$userReport) {
            return redirect()->back()->with('error', 'Leden export niet gevonden.');
        }

        Storage::disk('local')->delete('/reports/' . $userReport->file_name);
        $userReport->delete();

        return redirect()->back()->with('success', 'Leden export is verwijderd.');
    }

    public function download(string $filename)
    {
        try {
            return Storage::disk('local')->download('/user_exports/' . $filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Leden export niet gevonden.');
        }
    }
}
