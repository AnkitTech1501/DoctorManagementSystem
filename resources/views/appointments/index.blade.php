@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Appointments</h2>

    @if($appointments->isEmpty())
    <p>No appointments available.</p>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->doctor->name }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ ucfirst($appointment->status) }}</td>
                <td>
                    <form action="{{ url('appointments/' . $appointment->id . '/status') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-control">
                            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Cancel</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Update Status</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection