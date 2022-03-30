@extends('base')

@section('title')
Mes clients
@endsection

@section('content')
@if (count((array)$clients)==0)
<div class="page-wrap d-flex flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 text-center">
        <span class="display-1 d-block"> &#9785; </span>
        <div class="my-4 lead">Vous n'avez aucun client pour le moment.</div>
      </div>
    </div>
  </div>
</div>
@else
<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col">Clients</th>
      <th scope="col">Animaux</th>
    </tr>
  </thead>

  <tbody>
    @foreach($clients as $client)
    <tr>
      <td><a href="{{route('client.show',['IDClient'=>$client->IDClient])}}">{{$client->NomClient}} {{$client->PrenomClient}}</a></td>
      <td>
        @foreach ($animals as $animal)
        @if ($client->IDClient==$animal->IDClient)
        <a href="{{route('animal.show', ['IDAnimal'=>$animal->IDAnimal, 'IDClient'=>$animal->IDClient ])}}">{{$animal->NomAnimal}}</a><br>
        @endif
        @endforeach
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@endsection