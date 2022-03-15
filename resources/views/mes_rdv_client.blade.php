@extends('base')

@section('title')
Mes rendez-vous
@endsection

@section('content')
    @foreach($consults as $consult)
    <div class="card-body">
        <p>{{$consult->DateCreneau}} avec le <a href="{{route('vetProfile.show', ['IDVeto'=>$consult->IDVeto])}}"> Dr {{$consult->NomVeto}}</a>
        pour <a href="{{route('Animal.show', ['IDAnimal'=>$consult->IDAnimal])}}">{{$consult->NomAnimal}}</a></p> 
    </div>
    @endforeach
@endsection