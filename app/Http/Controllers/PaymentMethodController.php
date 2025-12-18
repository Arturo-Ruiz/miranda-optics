<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PaymentMethod::query();

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $paymentMethods = $query->orderBy('name')->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'paymentMethods' => $paymentMethods,
                'pagination' => (string) $paymentMethods->appends($request->all())->links()
            ]);
        }

        return view('payment_methods.index', compact('paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:payment_methods,name'],
            'is_usd' => ['boolean'],
        ]);

        $paymentMethod = PaymentMethod::create([
            'name' => $validated['name'],
            'is_usd' => $request->has('is_usd') ? $request->boolean('is_usd') : false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Método de pago creado exitosamente.',
            'paymentMethod' => $paymentMethod
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:payment_methods,name,' . $paymentMethod->id],
            'is_usd' => ['boolean'],
        ]);

        $paymentMethod->update([
            'name' => $validated['name'],
            'is_usd' => $request->has('is_usd') ? $request->boolean('is_usd') : false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Método de pago actualizado exitosamente.',
            'paymentMethod' => $paymentMethod
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return response()->json([
            'success' => true,
            'message' => 'Método de pago eliminado exitosamente.'
        ]);
    }
}
