@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <h2> Editar tópico </h2> <hr>
    </div>

    <div class="col-12">
      <form action="{{route('threads.update', $thread->slug)}}" method="post">
        @csrf 
        @method('PUT')

        <div class="form-group">
          <label for="body_text"> Tópico: </label>
          <input name="title" type="text" class="form-control" value="{{$thread->title}}">
        </div>

        <div class="form-group">
          <label for="body_text"> Conteúdo tópico: </label>
          <textarea name="body" id="body_text" cols="30" rows="10" class="form-control">{{$thread->body}}</textarea>
        </div>

        <button type="submit" class="btn btn-large btn-success">Atualizar</button>
      </form>
    </div>
  </div>
@endsection