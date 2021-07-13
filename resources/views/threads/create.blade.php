@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <h2> Criar tópico </h2> <hr>
    </div>

    <div class="col-12">
      <form action="{{route('threads.store')}}" method="post">
        @csrf

        <div class="form-group">
          <label> Selecione um canal para o tópico </label>
          <select name="channel_id" id="" class="form-control">
            @foreach($channels as $channel)
              <option value="{{$channel->id}}">{{$channel->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="body_text"> Tópico: </label>
          <input name="title" type="text" class="form-control" value="">
        </div>

        <div class="form-group">
          <label for="body_text"> Conteúdo tópico: </label>
          <textarea name="body" id="body_text" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-large btn-success">Criar tópico</button>
      </form>
    </div>
  </div>
@endsection