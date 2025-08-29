<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProduitCreateRequest;
use Illuminate\Http\Request;
use App\Models\produit;
use Illuminate\Support\Str;
//use Illuminate\Routing\Controllers\HasMiddleware;
//use Illuminate\Routing\Controllers\Middleware;

class ProduitController extends Controller
{

//     public static function middleware(): array
// {
//     return [
//         // examples with aliases, pipe-separated names, guards, etc:
//         'role_or_permission:manager|edit articles',
//         new Middleware('role:author', only: ['index']),
//         new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except:['show']),
//         new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete records,api'), only:['destroy']),
//     ];
// }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("produit", [
            'produits' => produit::all()
        ]);
    }
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:Admin', 'permission:edit produit'])->only(['update', 'edit']);
        $this->middleware(['role:Admin', 'permission:create produit'])->only(['create','store']);
        $this->middleware(['role:Admin', 'permission:delete produit'])->only(['destroy']);
        $this->middleware(['role:Admin', 'permission:read produit'])->only(['index']);
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
    public function store(ProduitCreateRequest $request)
    {
        produit::create([
            'nom' => $request->nom,
            'prix_vente' => $request->prix,
            'description' => $request->description,
            'slug' => Str::slug($request->nom),
        ]);

        return back()->with("success", "Produit ajouté avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view("produit_edit", [
            'produit' => produit::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $produit = produit::find($id);
        $produit->update([
            'nom' => $request->nom,
            'prix_vente' => $request->prix,
            'description' => $request->description,
            'slug' => Str::slug($request->nom),
        ]);

        return redirect()->route('produits.index')->with("success", "Produit mis à jour avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        produit::destroy($id);
        return redirect()->route('produits.index')->with("success", "Produit supprimé avec succès");
        
    }
}
