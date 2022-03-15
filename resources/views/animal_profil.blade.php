@extends('base')

@section('title')
Fiche Animal de {{$animal->NomAnimal}}
@endsection


@section('content')
<b> Nom : </b>{{$animal->NomAnimal}}<br>
<b> Date de naissance : </b>{{$animal->DateNaissAnimal}}<br>
<b> Stérilisation : </b>{{$animal->SterilisationAnimal}}<br>
<b> Poids : </b>{{$animal->PoidsAnimal}}<br>
<b> Sexe : </b>{{$animal->SexeAnimal}}<br>
<b> Type : </b>{{$animal->TypeAnimal}}<br>
<b> Pathologies : </b>{{$animal->PathologiesAnimal}}<br>

<form>
  <input type="button" value="Retour" onclick="history.go(-1)">
</form>



@endsection