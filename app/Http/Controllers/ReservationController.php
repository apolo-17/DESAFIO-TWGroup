<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations;
        return view('reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coworking_space_id' => 'required|exists:coworking_spaces,id',
            'reservation_time' => 'required|date|after_or_equal:now',
        ]);

        $conflict = Reservation::where('coworking_space_id', $request->coworking_space_id)
            ->where('reservation_time', $request->reservation_time)
            ->exists();

        if ($conflict) {
            return back()->withErrors(['reservation_time' => 'Este espacio ya está reservado para la hora seleccionada.']);
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'coworking_space_id' => $request->coworking_space_id,
            'reservation_time' => $request->reservation_time,
            'status' => 'Pending',
        ]);

        return redirect()->route('reservations.index');
    }
}
