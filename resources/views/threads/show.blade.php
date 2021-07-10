@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <h2> {{$thread->title}} </h2> <hr>
    </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <small> Criado por: <b>{{ $thread->user->name }}</b> há: <b> {{ $thread->created_at->diffForHumans() }} </b> </small>
        </div>
        <div class="card-body">
          {{ $thread->body }}
        </div>
        <div class="card-footer">
          <a href="{{route('threads.edit', $thread->slug)}}" class="btn btn-sm btn-primary"> Editar </a>
          <form action="{{route('threads.destroy', $thread->slug)}}" method="post">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"> Remover</button>
          </form>
        </div>
      </div>
      <hr>
    </div>
  </div>
@endsection