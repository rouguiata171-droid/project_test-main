<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return categories::all();
    }

    
    public function store(Request $request)
    {
        //
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $categories = categories::create([
            'name' => $request->nom,
            'description' => $request->description,
        ]);
        return $categories;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return categories::find($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'requiered'
        ]);
        $categories = categories::find($id);

        $categories->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return $categories;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
