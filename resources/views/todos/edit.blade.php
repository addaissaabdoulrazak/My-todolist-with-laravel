@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-header">
    <h4 class="card-title"> Modification de la Todo <span class="badge bg-dark">#{{$todo->id}}</span></h4>
  </div>
  <div class="card-body">
    <form action="{{route('todos.update',$todo->id)}}" method="post">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="exampleFormControlInput1">Titre</label>
        <input name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Titre" value="{{old('name',$todo->name)}}">
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput2">La description</label>
        <textarea name="description" type="text" class="form-control" id="exampleFormControlInput2" placeholder="description">{{old('description',$todo->description)}}</textarea>
      </div>
      <div class="form-check m-2">
        <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="done" {{$todo->done==1 ? 'checked' : ''}} value=1>
        <label class="form-check-label" for="flexCheckDefault">
          Done ?
        </label>
      </div>
      <div>
        <input type="submit" value="Mettre à jour" class="btn btn-primary m-2">
      </div>
    </form>
  </div>
</div>
@endsection