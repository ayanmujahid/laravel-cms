<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AttendanceController extends Controller
{
    //
   public function index()
{
    $user = Auth::user();
    $attendances = Attendance::where('user_id', $user->id)
        ->orderByDesc('date')
        ->get();

    return view('attendance.index', compact('attendances'));
}


public function store(Request $request)
{
    $user = auth()->user();
    $date = now()->toDateString();
    $time = now()->format('H:i:s');

    // Check if already marked
    $existing = Attendance::where('user_id', $user->id)->where('date', $date)->first();
    if ($existing) {
        return back()->with('error', 'Attendance already marked for today.');
    }

    // Check if late (after 9:30 AM)
    $cutoff = Carbon::createFromTime(9, 30, 0);
    $current = now();
    $status = $current->gt($cutoff) ? 'Late' : 'On Time';

    Attendance::create([
        'user_id' => $user->id,
        'date' => $date,
        'time' => $time,
        'status' => $status,
    ]);

    return back()->with('success', 'Attendance marked as ' . $status);
}


public function create()
{
    return view('attendance.create');
}
}
