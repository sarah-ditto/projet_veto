@extends('base')

@section('title')
Fiche Animal de {{$animal->NomAnimal}}
@endsection


@section('content')
<ul class="nav nav-tabs">
  <li class='nav-item'>
    <a class='nav-link active' data-toggle='tab' href='#s1'>Identité</a>
  </li>
  <li class='nav-item'>
    <a class='nav-link ' data-toggle='tab' href='#s2'>Consultations</a>
  </li>
</ul>
<div class="tab-content">
  <div class='tab-pane container fade in show active' id='s1'>
    <b> Nom : </b>{{$animal->NomAnimal}}<br>
    <b> Date de naissance : </b>{{$animal->DateNaissAnimal}}<br>
    <b> Stérilisation : </b>{{$animal->SterilisationAnimal}}<br>
    <b> Poids : </b>{{$animal->PoidsAnimal}} kg<br>
    <b> Sexe : </b>{{$animal->SexeAnimal}}<br>
    <b> Type : </b>{{$animal->TypeAnimal}}<br>
    <b> Pathologies : </b>{{$animal->PathologiesAnimal}}<br>
  </div>
  <div class='tab-pane container fade' id='s2'>
    <table class="table table-bordered mt-3">
      <thead class="thead-light">
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Docteur</th>
          <th scope="col">Motif</th>
          <th scope="col">Observations</th>
          @if (session()->get('userType')==1)
          <th scope="col">Action</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach ($consults as $consult)
        <tr>
          <td>{{$consult->DateCreneau}}</td>
          <td><a href="{{route('vetProfile.show', ['IDVeto'=>$consult->IDVeto])}}">{{$consult->PrenomVeto}} {{$consult->NomVeto}}</a></td>
          <td>{{nl2br($consult->MotifConsult,false)}}</td>
          <td>{{$consult->ObsConsult}}</td>
          @if (session()->get('userType')==1 && session()->get('user')==$consult->IDVeto)
          <td><a class="btn btn-outline-success" href="{{route('updateAppointment.show',['IDClient'=>$consult->IDClient,'IDAnimal'=>$consult->IDAnimal,'IDConsult'=>$consult->IDConsult])}}">Modifier</a></td>
          @endif
        </tr>

        @endforeach
      </tbody>

    </table>

  </div>
</div>
<form>
  <input type="button" value="Retour" onclick="history.go(-1)">
</form>



@endsection