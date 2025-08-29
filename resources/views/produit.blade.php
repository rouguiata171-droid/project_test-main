

@extends('layouts.master')

@section('content')
    <div class="container">
        <form action = "{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Deconnexion</button>
        </form>
        <h3 class="alert-info alert mt-5">Gestion des produits</h3>
        <form action="{{ route("produits.store") }}" method="post">
            @csrf
            <div class="form-froup">
                <label for="">Nom du produit</label>
                <input type="text" name="nom" id="" class="form-control @error('nom') is-invalid @enderror">
            </div>
            @error('nom')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Prix</label>
                <input type="number" name="prix" id="" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            @can('create produit')
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            @endcan
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        </form>

        <div class="table mt-4">
            <table class="table table-bordered">
                <thead>
                    <td>id</td>
                    <td>Nom</td>
                    <td>Prix</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    @foreach ($produits as $produit)
                        <tr>
                            <td>{{ $produit->id }}</td>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->prix_vente }}</td>
                            <td>
                                @can('update produit') 
                                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning">Modifier</a>
                                @endcan
                                @can('delete produit')
                                <a href="#" data-href="{{ route('produits.destroy', $produit->id) }}" class="btn btn-danger btn-delete">supprimer</a>
                                @endcan
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('.btn-delete').click(function(e){
            e.preventDefault();
            const href = $(this).attr('data-href');
            if(confirm("Voulez-vous vraiment supprimer ce produit ?")){
                $.ajax({
                    url: href,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        // Code à exécuter en cas de succès
                        window.location.reload();
                    },
                    error: function(xhr) {
                        // Code à exécuter en cas d'erreur
                        alert("Une erreur s'est produite lors de la suppression du produit.");
                    }
                });
            }
        });
    });
</script>


