<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       return Produit::all();
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix_vente' => 'required|integer',
            'description' => 'nullable|string',
        ]);
        $request->merge(['slug' => Str::slug($request->nom)]);
        $produit = Produit::create([
            'nom' => $request->nom,
            'prix_vente' => $request->prix_vente,
            'description' => $request->description,
            'slug' => \Str::slug($request->nom),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Produit::find($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
