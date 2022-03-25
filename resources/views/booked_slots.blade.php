@extends('base')

@section('title')
Mes Rendez-Vous 
@endsection

@section('content')
@if (count((array)$consultations)==0)
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block"> &#9785; </span>
                <div class="my-4 lead">Vous n'avez aucun rendez-vous prévu.</div>
            </div>
        </div>
    </div>
</div>
@else
<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col">Date & heure</th>
      <th scope="col">Client</th>
      <th scope="col">Animal</th>
    </tr>
  </thead>
  <tbody>
  @foreach($consultations as $consult )                        
    <tr>
        <td class="col-md-3 border-top "> {{$consult->DateCreneau}}</td>
        <td class="col-md-3 border-top "> <a href="{{route('client.show',['IDClient'=>$consult->IDClient])}}">{{$consult->NomClient}} {{$consult->PrenomClient}}</a> </td>
        <td class="col-md-3 border-top "> <a href="{{route('animal.show', ['IDAnimal'=>$consult->IDAnimal, 'IDClient'=>$consult->IDClient ])}}"> {{$consult->NomAnimal}}</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
@endsection
