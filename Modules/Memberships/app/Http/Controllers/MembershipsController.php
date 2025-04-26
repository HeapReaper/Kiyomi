<?php

namespace Modules\Memberships\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Memberships\Models\Membership;

class MembershipsController extends Controller
{
    public function index()
    {
        return view('memberships::index', [
            'memberships' => Membership::all(),
        ]);
    }

    public function create()
    {
        return view('memberships::create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:memberships,name'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'payment_frequency' => ['required', 'integer'],
            'active' => ['nullable', 'integer'],
        ]);

        try {
            Membership::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'payment_frequency' => $validated['payment_frequency'],
                'active' => isset($validated['active']) ? 1 : 0,
            ]);

            return redirect()->route('memberships.index')->with('success', 'Membership created successfully.');
        } catch (\Exception $error) {
            Log::channel('laravel')->error($error->getMessage());
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    public function show($id)
    {
        return view('memberships::show');
    }

    public function edit(int $id)
    {
        return view('memberships::edit', [
            'membership' => Membership::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'payment_frequency' => ['required', 'integer'],
            'active' => ['nullable', 'integer'],
        ]);

        try {
            $membership = Membership::where('id', $id)->first();

            $membership->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'payment_frequency' => $validated['payment_frequency'],
                'active' => isset($validated['active']) ? 1 : 0,
            ]);

            return redirect()->route('memberships.index')->with('success', 'Membership updated successfully.');
        } catch (\Exception $error) {
            Log::channel('laravel')->error($error->getMessage());
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    public function destroy(int $id)
    {
        //
    }
}
