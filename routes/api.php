<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\categoriesController;

Route::resource("produit", ProduitController::class);

Route::post("ajouter-produit", [ProduitController::class, "store"]);

Route::resource("categories", categoriesController::class);