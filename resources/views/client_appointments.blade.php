@extends('base')

@section('title')
Mes rendez-vous
@endsection

@section('content')
    @foreach($consults as $consult)
    <div class="d-flex-column p-2 m-1 border rounded ">
        {{$consult->DateCreneau}} avec le <a href="{{route('vetProfile.show', ['IDVeto'=>$consult->IDVeto])}}"> Dr {{$consult->NomVeto}}</a>
        pour <a href="{{route('animal.show', ['IDAnimal'=>$consult->IDAnimal, 'IDClient'=>$consult->IDClient ])}}"> {{$consult->NomAnimal}}</a> 
    </div>
    @endforeach
@endsection