<?php

namespace App\Http\Controllers;

use App\Models\Journal_Entrie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class JournalEntrieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua journal dengan visibility public
        $publicJournals = Journal_Entrie::where('visibility', 'public')
            ->orderBy('created_at', 'desc')
            ->get();

        $myJournals = Journal_Entrie::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')->get();

        return view('user.journal.journal', compact('publicJournals', 'myJournals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'visibility' => 'required|in:public,private',
        ]);

        Journal_Entrie::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'visibility' => $request->visibility,
        ]);

        return redirect()->back()->with('success', 'Journal berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Journal_Entrie $journal_Entrie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $journal = Journal_Entrie::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail(); // Hanya jurnal milik user

        return view('user.journal.edit', compact('journal'));
    }

    public function update(Request $request, $id)
    {
        $journal = Journal_Entrie::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'visibility' => 'required|in:public,private',
        ]);

        $journal->update($request->only('title', 'content', 'visibility'));

        return redirect()->route('journal')->with('success', 'Journal berhasil diupdate!');
    }

    public function destroy($id)
    {
        $journal = Journal_Entrie::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $journal->delete();

        return redirect()->route('journal')->with('success', 'Journal berhasil dihapus!');
    }

    public function chatbot()
    {
        return view('user.chatbot.index');
    }
}
