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
          <a href="#" class="btn btn-sm btn-danger"
            onclick="event.preventDefault(); document.querySelector('form.thread-rm').submit();" > Remover </a>

          <form action="{{route('threads.destroy', $thread->slug)}}" class="thread-rm" method="post">
            @csrf 
            @method('DELETE')
          </form>
        </div>
      </div>
      <hr>
    </div>
  </div>
@endsection

<style>
  .thread-rm {
    display:none;
  }
</style>