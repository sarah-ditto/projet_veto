@extends('base')

@section('title')
Mes rendez-vous
@endsection

@section('content')
    @foreach($consults as $consult)
    <div class="card-body">
        <p>{{$consult->DateCreneau}}</p>
        <p><a href="{{route('vetProfile.show', ['IDVeto'=>$consult->IDVeto])}}"> Dr {{$consult->NomVeto}}</a></p>
        <p>Pour {{$consult->NomAnimal}}</p> 
        <!-- ajouter lien vers fiche animal de kenza <3 -->
    </div>
    @endforeach
@endsection