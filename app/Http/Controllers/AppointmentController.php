<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('patient_id', Auth::id())->get();
        return view('appointments.index', compact('appointments'));
    }

    // Create a new appointment
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|unique:appointments,appointment_date',
        ]);

        Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index');
    }

    // Update the appointment status (for patient)
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Only the patient can update their own appointments
        if ($appointment->patient_id !== Auth::id()) {
            return back()->withErrors(['message' => 'Unauthorized']);
        }

        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('appointments.index');
    }
}
