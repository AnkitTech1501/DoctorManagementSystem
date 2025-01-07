<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('doctor_id', Auth::id())->get();
        return view('appointments.doctor', compact('appointments'));
    }

    // Update the status of the appointment (for doctor)
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Check if the logged-in user is the assigned doctor
        if ($appointment->doctor_id !== Auth::id()) {
            return back()->withErrors(['message' => 'Unauthorized']);
        }

        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('doctor.appointments.index');
    }
}
