@extends('base')

@section('title')
Mes rendez-vous
@endsection

@section('content')
    @foreach($futureConsults as $consult)
    <div class="row">
    <div class="col-sm p-2 m-1 border rounded ">
        {{$consult->DateCreneau}} avec le <a href="{{route('vetProfile.show', ['IDVeto'=>$consult->IDVeto])}}"> Dr {{$consult->NomVeto}}</a>
        pour <a href="{{route('animal.show', ['IDAnimal'=>$consult->IDAnimal, 'IDClient'=>$consult->IDClient ])}}"> {{$consult->NomAnimal}}</a> 
    </div>
    <div class="col-sm p-2 m-1">
    <form method="POST" action="{{route('deleteAppointment.post', ['IDConsult'=>$consult->IDConsult])}}">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Supprimer</a>
    </form>
    </div>
    </div>
    @endforeach
    <p>
  <a class="btn btn-primary dropdown-toggle m-2" data-toggle="collapse" href="#Rep1" role="button" aria-expanded="false" aria-controls="collapseExample">
    Vos précédents rendez-vous
  </a>
</p>
<div class="collapse" id="Rep1">
  <div class="card card-body mb-3">
  @foreach($pastConsults as $consult)
    <div class="d-flex-column p-2 m-1 border rounded ">
        {{$consult->DateCreneau}} avec le <a href="{{route('vetProfile.show', ['IDVeto'=>$consult->IDVeto])}}"> Dr {{$consult->NomVeto}}</a>
        pour <a href="{{route('animal.show', ['IDAnimal'=>$consult->IDAnimal, 'IDClient'=>$consult->IDClient ])}}"> {{$consult->NomAnimal}}</a> 
    </div>
    @endforeach
  </div>
</div>
@endsection