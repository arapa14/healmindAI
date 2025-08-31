<?php

namespace App\Http\Controllers;

use App\Models\Journal_Entrie;
use App\Models\Recomendation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RecomendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recomendations = Recomendation::latest()->get();
        return view('user.recomendation.index', compact('recomendations'));
    }

    // Halaman utama: journal + recomendation
    public function recomendations()
    {
        $myJournals = Journal_Entrie::where('user_id', Auth::id())->get();
        $publicJournals = Journal_Entrie::where('visibility', 'public')->get();

        $myRecomendations = Recomendation::where('source', 'professional')->get();
        $allRecomendations = Recomendation::all();

        return view('professional.recomendations.index', compact(
            'myJournals',
            'publicJournals',
            'myRecomendations',
            'allRecomendations'
        ));
    }

    // CRUD Journal
    public function storeJournal(Request $request)
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

        return back()->with('success', 'Journal berhasil ditambahkan.');
    }

    public function updateJournal(Request $request, $id)
    {
        $journal = Journal_Entrie::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'visibility' => 'required|in:public,private',
        ]);

        $journal->update($request->only('title', 'content', 'visibility'));

        return back()->with('success', 'Journal berhasil diperbarui.');
    }

    public function destroyJournal($id)
    {
        $journal = Journal_Entrie::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $journal->delete();

        return back()->with('success', 'Journal berhasil dihapus.');
    }

    // CRUD Recomendation
    public function storeRecomendation(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'related_journal_id' => 'nullable|exists:journal__entries,id',
        ]);

        Recomendation::create([
            'title' => $request->title,
            'source' => 'professional',
            'related_journal_id' => $request->related_journal_id,
        ]);

        return back()->with('success', 'Recomendation berhasil ditambahkan.');
    }

    public function updateRecomendation(Request $request, $id)
    {
        $recomendation = Recomendation::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'related_journal_id' => 'nullable|exists:journal__entries,id',
        ]);

        $recomendation->update($request->only('title', 'related_journal_id'));

        return back()->with('success', 'Recomendation berhasil diperbarui.');
    }

    public function destroyRecomendation($id)
    {
        $recomendation = Recomendation::findOrFail($id);
        $recomendation->delete();

        return back()->with('success', 'Recomendation berhasil dihapus.');
    }
}
