<?php

namespace App\Http\Controllers;

use App\Models\Recomendation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Recomendation $recomendation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recomendation $recomendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recomendation $recomendation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recomendation $recomendation)
    {
        //
    }
}
