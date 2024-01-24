<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplaintSuggestion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintSuggestionController extends Controller
{
    /**
     * View complaint suggestion page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $user = Auth::user();

        $suggestions = ComplaintSuggestion::where([
            'type'  => 1,
            'reply' => null,
        ])->get();

        $complaints = ComplaintSuggestion::where([
            'type'  => 2,
            'reply' => null,
        ])->get();

        $count = ComplaintSuggestion::where('reply', '')->count();

        return view('admin.complaint_suggestion', compact('user', 'suggestions', 'complaints', 'count'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:1,2',
            'body' => 'required|string',
            'rating' => 'nullable|numeric|min:1|max:5',
        ]);
        $complaintSuggestion = new ComplaintSuggestion();
        $complaintSuggestion->user_id = Auth::id();
        $complaintSuggestion->type = $request->type;
        $complaintSuggestion->body = $request->body;

        if ($request->type == 2 && $request->has('rating')) {
            $complaintSuggestion->rating = $request->rating;
        }
        $complaintSuggestion->save();

        return redirect()->back()->with('success', 'Terima kasih atas feedback Anda!');
    }


    /**
     * Get complaint suggestion by id
     *
     * @param  \App\Models\ComplaintSuggestion $complaintSuggestion
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ComplaintSuggestion $complaintSuggestion): JsonResponse
    {
        return response()->json($complaintSuggestion);
    }

    /**
     * Send complaint suggestion reply
     *
     * @param  \App\Models\ComplaintSuggestion $complaintSuggestion
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ComplaintSuggestion $complaintSuggestion, Request $request): JsonResponse
    {
        $complaintSuggestion->reply = $request->input('reply');
        $complaintSuggestion->save();

        return response()->json();
    }
}
