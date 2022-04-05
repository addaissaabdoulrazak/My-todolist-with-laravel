@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        Creation d'une nouvelle Todo
    </div>
    <div class="card-body">
        <form action="{{route('todos.store')}}" method="post">
            <!-- laravel oblige l'utilisation du @csrf permettant ainsi la protection de nos formulaire contre
                 les attaques csrf sinon erreur 419 -->
            @csrf
            <div class="form-group">
                <label for="exampleFormControlInput1">Titre</label>
                <input name="titre" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titre">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">La description</label>
                <textarea name="description" type="text" class="form-control" id="exampleFormControlInput2" placeholder="description"></textarea>
            </div>
            <div>
                <input type="submit" value="Ajouter" class="btn btn-primary m-2">
            </div>

        </form>
    </div>
</div>

@endsection