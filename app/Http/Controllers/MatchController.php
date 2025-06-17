<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Interest;

class MatchController extends Controller
{
    // Main Find Matches page
    public function index(Request $request)
    {
        $user = auth()->user();
        $gender = $user->gender == 'male' ? 'female' : 'male';

        // Build the query for opposite gender profiles (except self)
        $matches = Profile::with('user')
            ->whereHas('user', function($q) use ($gender, $user) {
                $q->where('gender', $gender)
                  ->where('id', '!=', $user->id);
            })
            // Filters:
            ->when($request->member_id, fn($q) => $q->where('user_id', $request->member_id))
            ->when($request->marital_status, fn($q) => $q->where('marital_status', $request->marital_status))
            ->when($request->religion, fn($q) => $q->where('religion', $request->religion))
            ->when($request->caste, fn($q) => $q->where('caste', 'like', '%' . $request->caste . '%'))
            ->when($request->mother_tongue, fn($q) => $q->where('mother_tongue', $request->mother_tongue))
            ->when($request->state, fn($q) => $q->where('state', $request->state))
            ->when($request->city, fn($q) => $q->where('city', 'like', '%' . $request->city . '%'))
            // Age filter (assume dob is stored)
            ->when($request->age_from, function($q) use ($request) {
                $minDate = now()->subYears($request->age_from)->format('Y-m-d');
                $q->where('dob', '<=', $minDate);
            })
            ->when($request->age_to, function($q) use ($request) {
                $maxDate = now()->subYears($request->age_to + 1)->addDay()->format('Y-m-d');
                $q->where('dob', '>=', $maxDate);
            })
            ->orderByDesc('created_at')
            ->paginate(12);

        // IDs of users current user has already sent a request to
        $sentRequests = Interest::where('from_user_id', $user->id)->pluck('to_user_id')->toArray();

        // Dropdowns (adjust as per your dynamic data or use static lists)
        $castes = Profile::distinct()->pluck('caste');
        $mother_tongues = Profile::distinct()->pluck('mother_tongue');
        $states = Profile::distinct()->pluck('state');

        return view('matches.index', compact('matches', 'sentRequests', 'castes', 'mother_tongues', 'states'));
    }

    // Send Interest/Request
    public function sendRequest($id)
    {
        $user = auth()->user();

        // Prevent duplicate requests
        $already = Interest::where('from_user_id', $user->id)
            ->where('to_user_id', $id)
            ->exists();

        if (!$already) {
            Interest::create([
                'from_user_id' => $user->id,
                'to_user_id' => $id,
                'status' => 'pending'
            ]);
        }

        return back()->with('success', 'Interest sent successfully!');
    }

    // Show Interests Sent page
    public function sentInterests()
    {
        $user = auth()->user();

        // Get all interests sent by current user, with recipient's profile & user
        $interests = Interest::with(['toUser.profile'])
            ->where('from_user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('matches.sent', compact('interests'));
    }

    // Show Interests Received page
    public function receivedInterests()
    {
        $user = auth()->user();

        // Get all interests where current user is the recipient, with sender's user & profile
        $interests = Interest::with(['fromUser.profile'])
            ->where('to_user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('matches.received', compact('interests'));
    }
}
