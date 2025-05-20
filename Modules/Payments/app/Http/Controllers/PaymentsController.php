<?php

namespace Modules\Payments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Modules\Payments\Models\Payment;
use Modules\Payments\Enums\PaymentStatusEnum;

class PaymentsController extends Controller
{
    public function index()
    {
        return view('payments::index', [
            'payments' => Payment::with('user')->get()
        ]);
    }

    public function create(): \Illuminate\Contracts\View\View
    {
        return view('payments::create', [
            'payments' => Payment::with('user')
                ->where('status', '!=', PaymentStatusEnum::PAID->value)
                ->get()
        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'for' => ['required', 'string'],
            'date' => ['required', 'date'],
            'amount_paid' => ['required', 'integer'],
            'payment_method' => ['required'],
        ]);

        try {
            $payment = Payment::findOrFail(explode('_', $validated['for'])[0]);

            $payment->update([
                'amount_paid' => $validated['amount_paid'],
            ]);

            return redirect()->route('payments.index')->with('success', 'Betaling ingevoerd!');
        } catch (\Exception $e) {
            return redirect()->route('payments.index')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        return view('payments::show');
    }

    public function edit($id)
    {
        return view('payments::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
