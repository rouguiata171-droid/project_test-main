<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mise a jour</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 alert alert-primary">Modifier le produit</h1>
        <form action="{{ route('produits.update', $produit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $produit->nom }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $produit->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="prix">Prix</label>
                <input type="text" class="form-control" id="prix" name="prix" value="{{ $produit->prix_vente }}" required>
            </div>
            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
</body>
</html>