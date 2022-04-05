@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div>
            <a href="{{route('todos.create')}}" id="" name="" role="button" class="btn btn-primary m-2">Ajouter une ToDo</a>
        </div>

        <!-- Certains événements de l'utilisateur ne concernent pas les données mais la vue.
         Dans ce cas, le contrôleur demande à la vue de se modifier. exactement comme ce qui a été éffectuer au dessous -->

        <!-- Logique programmative -->
        @if(Route::currentRouteName()== 'todos.index')
        <div>
            <a href="{{route('todos.undone')}}" id="" name="" role="button" class="btn btn-warning m-2">Voir les Todos ouvertes</a>
        </div>
        <div>
            <a href="{{route('todos.done')}}" id="" name="" role="button" class="btn btn-success m-2">Voir les Todos Terminer</a>
        </div>
        @elseif(Route::currentRouteName()== 'todos.done')
        <div>
            <a href="{{route('todos.index')}}" id="" name="" role="button" class="btn btn-dark m-2">Voir Tout les Todo</a>
        </div>
        <div>
            <a href="{{route('todos.undone')}}" id="" name="" role="button" class="btn btn-warning m-2">Voir les Todos ouvertes</a>
        </div>
        <!--Fin todos.done  -->
        @elseif(Route::currentRouteName()=='todos.undone')
        <div>
            <a href="{{route('todos.index')}}" id="" name="" role="button" class="btn btn-dark m-2">Voir Tout les Todo</a>
        </div>
        <div>
            <a href="{{route('todos.done')}}" id="" name="" role="button" class="btn btn-success m-2">Voir les Todos Terminer</a>
        </div>
        <!-- Fin todo.undone -->
        @endif
    </div>
</div>
<!-- recuperation du modèle ayant été transmis par le controller puis parcour de ce model -->
@foreach($datas as $value)
<h4>
    <div class="alert alert-{{$value->done==1 ? 'success' : 'warning'}}" role="alert">
        <!-- deux col-sm => obtenir deux colone sur la même ligne -->
        {{--Bouton Done/Undone (ceci est une autre façon de faire un commentaire)--}}
        <div class="row">
            <div class="col-sm">
                <p class="my-0">
                    <strong>
                        <span class="badge bg-dark">#{{$value->id}}</span>
                    </strong>
                </p>
                <small>

                </small>
                <!--  -->
                <small>

                </small>

                <!-- details -->
                <details>
                    <summary>
                        <strong>
                            {{$value->name}} @if($value->done)<span class="badge bg-success" role='badge'>Done</span> @endif
                        </strong>
                    </summary>
                    <p>
                        {{$value->description}}
                    </p>
                </details>

            </div>
            <div class="d-flex justify-content-end">
                <!-- Bouton affected to -->
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Affecté à
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                        @foreach($users as $user)
                        <li><a class="dropdown-item" href="/todos/{{$value->id}}/affectTo/{{$user->id}}">{{$user->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- FIN -->

                <!-- Bouton Done / Undone -->
                @if($value->done)
                <form action=" {{route('todos.makedone',$value->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <!--  if($value->done) btn btn-success -->
                    <button type="submit" class="btn btn-success mx-1" style="min-width:90px;">Done</button>
                </form>
                @else
                <form action="{{route('todos.makedone',$value->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <!-- else btn btn-warning -->
                    <button type="submit" class="btn btn-warning mx-1" style="min-width:90px;">Undone</button>
                </form>
                @endif
                <!-- Fin Done / Undone -->

                <!-- Link: Bouton Edit -->
                <a id="" name="" href="{{route('todos.edit', $value->id)}}" role="button" class="btn btn-info mx-1">Editer</a>

                <!-- Form: Bouton Delete -->
                <form action="{{route('todos.destroy',$value->id)}}" method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger mx-1">Delete</button>
                </form>
            </div>
        </div>
    </div>
</h4>

@endforeach
<!-- pagination de page -->
{{$datas->links()}}
@endsection