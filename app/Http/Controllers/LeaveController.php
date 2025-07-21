<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;

class LeaveController extends Controller
{
    //
  public function index()
{
    $user = auth()->user();

    $currentMonth = now()->format('Y-m');
    $previousMonth = now()->subMonth()->format('Y-m');

    // Current month leave records
    $currentLeaves = Leave::where('user_id', $user->id)
        ->whereRaw("DATE_FORMAT(leave_date, '%Y-%m') = ?", [$currentMonth])
        ->orderBy('leave_date', 'asc')
        ->get();

    // Previous month leave records
    $previousLeaves = Leave::where('user_id', $user->id)
        ->whereRaw("DATE_FORMAT(leave_date, '%Y-%m') = ?", [$previousMonth])
        ->orderBy('leave_date', 'asc')
        ->get();

    // Leave balance: 1 - leaves taken
    $leaveBalance = 1 - $currentLeaves->count(); // can go negative

    return view('sick-leaves.index', [
        'currentLeaves' => $currentLeaves,
        'previousLeaves' => $previousLeaves,
        'leaveBalance' => $leaveBalance,
    ]);
}



    public function store(Request $request)
    {
        $request->validate([
            'leave_date' => 'required|date',
            'reason' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $month = now()->format('Y-m');
        $leaveCount = Leave::where('user_id', $user->id)
            ->whereRaw("DATE_FORMAT(leave_date, '%Y-%m') = ?", [$month])
            ->count();

        // Store the leave regardless of count (it may go negative)
        Leave::create([
            'user_id' => $user->id,
            'leave_date' => $request->leave_date,
            'reason' => $request->reason,
        ]);

        return redirect()->route('leaves.index')->with('notify_success', 'Leave applied successfully. Leaves used this month: ' . ($leaveCount + 1));
    }

    public function create()
    {
        return view('sick-leaves.create')->with('title', 'Apply for Leave'); // Assuming you have a create.blade.php view for applying leaves
    }
}
