@extends('base')

@section('title')
Résultats de la recherche
@endsection

@section('content')
@if (count($vetos)==0)
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block"> &#9785; </span>
                <div class="my-4 lead">Aucun résultat ne correspond à votre recherche.</div>
                <a href="{{route('welcome.show')}}" class="btn btn-link">Retourner vers la page d'accueuil</a>
            </div>
        </div>
    </div>
</div>
@else
<div>
    @foreach($vetos as $veto)
    <div class="col-md-10 border-top ">
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-2 py-1"><img class="rounded-circle mt-3" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold">Dr {{$veto->PrenomVeto}} {{$veto->NomVeto}}</span>
                        <span></span>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Informations</h4>
                        </div>
                        <div class="row mt-3">
                            <span class="material-icons mr-2">place</span>{{$veto->NumRueVeto}} {{$veto->NomRueVeto}} {{$veto->CodePostalVeto}} {{$veto->Ville}}
                        </div>
                        <div class="row mt-3">
                            <span class="material-icons mr-2">phone</span>{{$veto->TelVeto}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Disponibilités</h4>
                        </div>
                        <table class="table table-striped">
                            @foreach($creneaux as $creneau)
                            @if ($creneau->IDVeto == $veto->IDVeto)
                            <tr>
                                <td class style="text-align: center; vertical-align: middle;"><a href="{{route('confirmSlot.show', ['IDCreneau'=>$creneau->IDCreneau])}}"> {{$creneau->DateCreneau}} </a></td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection