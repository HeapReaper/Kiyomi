<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

            $fileName = Str::uuid()->toString() . '.pdf';

            $pdf = PDF::loadView('users::pages.users_export_pdf', [
                'users'          => $users,
                'included_roles' => $validated['include_members'],
            ])->setPaper('a4', 'landscape');

            Storage::disk('minio')->put('reports/members/' . $fileName, $pdf->download()->getOriginalContent());

            UserExport::create([
                'file_name' => $fileName,
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

        Storage::disk('minio')->delete('reports/members/' . $userReport->file_name);
        $userReport->delete();

        return redirect()->back()->with('success', 'Leden export is verwijderd.');
    }

    public function download(string $filename)
    {
        try {
            return Storage::disk('minio')->download('reports/members/' . $filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Leden export niet gevonden.');
        }
    }
}
