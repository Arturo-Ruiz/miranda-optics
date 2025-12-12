<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

use PDF;

class PatientController extends Controller
{
    /**
     * Display a listing of patients with search and filtering.
     */
    public function index(Request $request)
    {
        $query = Patient::query();

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('id_card', 'like', "%{$search}%");
            });
        }

        // Order by creation date (newest first)
        $patients = $query->orderBy('created_at', 'desc')->paginate(10);

        // If it's an Ajax request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'patients' => $patients
            ]);
        }

        return view('patients.index', compact('patients'));
    }

    /**
     * Store a newly created patient.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'id_card' => ['required', 'string', 'max:50', 'unique:patients'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
            'optical_formula' => ['nullable', 'array'],
        ]);

        // Add +58 prefix to phone number for WhatsApp
        $validated['phone'] = '+58' . $validated['phone'];

        $patient = Patient::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paciente creado exitosamente.',
            'patient' => $patient
        ]);
    }

    /**
     * Display the specified patient.
     */
    public function show(Patient $patient)
    {
        return response()->json([
            'success' => true,
            'patient' => $patient
        ]);
    }

    /**
     * Print optical formula for patient as PDF.
     */
    public function printFormula(Patient $patient)
    {
        $pdf = PDF::loadView('patients.pdf-formula', compact('patient'));
        
        return $pdf->download('formula_optica_' . str_replace(' ', '_', $patient->full_name) .  '.pdf');
    }

    /**
     * Print optical formula for patient as PDF.
     */
    public function printFormulaDouble(Patient $patient)
    {
        $copies = 2;
        $pdf = PDF::loadView('patients.pdf-formula', compact('patient', 'copies'))
                    ->setPaper('letter', 'landscape');

        return $pdf->download('formula_optica_doble_' . str_replace(' ', '_', $patient->full_name) . '.pdf');
    }

    /**
     * Update the specified patient.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'id_card' => ['required', 'string', 'max:50', 'unique:patients,id_card,' . $patient->id],
            'occupation' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
            'optical_formula' => ['nullable', 'array'],
        ]);

        // Add +58 prefix to phone number for WhatsApp
        $validated['phone'] = '+58' . $validated['phone'];

        $patient->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paciente actualizado exitosamente.',
            'patient' => $patient
        ]);
    }

    /**
     * Remove the specified patient.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json([
            'success' => true,
            'message' => 'Paciente eliminado exitosamente.'
        ]);
    }
}
