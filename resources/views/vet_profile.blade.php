@extends('base')

@section('title')
Profil du Dr {{$veto->PrenomVeto}} {{$veto->NomVeto}}
@endsection

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold">Dr {{$veto->PrenomVeto}} {{$veto->NomVeto}}</span>
                @if (session()->get('user')==$veto->IDVeto)
                <span class="text-black-50">{{$veto->MailVeto}}</span>
                @endif
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
                <div class="row mt-3">
                    <span class="material-icons mr-2">comment</span> <b>A propos : </b>
                </div>
                <div class="row mt-2">
                    {{$veto->PresentationVeto}}
                </div>

                <div class="row mt-3">
                    <span class="material-icons mr-2">pets</span><b>Type(s) d'animaux pris en charge : </b>
                </div>
                <div class="row mt-2">
                    <ul>
                        @foreach ($pecs as $pec)
                        <li>{{$pec->EspeceAnimal}}</li>
                        @endforeach
                    </ul>
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
                    <tr>
                        <td style="text-align: center; vertical-align: middle;"><a href="{{route('confirmSlot.show', ['IDCreneau'=>$creneau->IDCreneau])}}"> {{$creneau->DateCreneau}} </a></td>
                    </tr>
                    @endforeach
                </table>


                <div id="map" style="height:400px; width: 800px;" class="my-3"></div>


            </div>
        </div>
    </div>

</div>
@endsection