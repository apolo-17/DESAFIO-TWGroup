<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function reservations(Request $request)
    {
        $query = Reservation::query();

        if ($request->has('search')) {
            $query->whereHas('coworkingSpace', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $reservations = $query->get();
        return view('Reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Accepted,Rejected',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $request->status]);

        return redirect()->route('admin.reservations');
    }
}
