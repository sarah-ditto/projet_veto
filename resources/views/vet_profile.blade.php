@extends('base')

@section('title')
<div class="d-flex flex-column align-items-center text-center ">
<span class="font-weight-bold" style="font-size: 25px;">Dr {{$veto->PrenomVeto}} {{$veto->NomVeto}}</span>
<span style="font-size: 18px; margin-left:-150px"> Vétérinaire</span>
</div>
@endsection

@section('content')



<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">

        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                <span class="font-weight-bold"> Dr {{$veto->PrenomVeto}} {{$veto->NomVeto}}</span>
                <span class="text-black-60"> <i class="material-icons" style="font-size:20px;  vertical-align: middle; margin-top: -.240ex;">mail_outline</i> {{ $veto->MailVeto}}</span>
            </div>
        </div>

        <div class="col-md-5 border-right">
            <div class="p-3 py-5" >
                <div class="d-flex justify-content-between align-items-center mb-3"></div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels"> <i class="material-icons" style="font-size:30px;  vertical-align: bottom; margin-top: -.240ex; margin-bottom:-15px; margin-right: 10px">location_city </i> {{$veto->NumRueVeto}} {{$veto->NomRueVeto}}</label></div>
                    <div class="col-md-6"><label class="labels" style="margin-left:42px">{{$veto->CodePostalVeto}} Marseille</label></div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels"> <i class="material-icons" style="font-size:30px;  vertical-align: bottom; margin-top: -.240ex; margin-right: 15px"> local_phone</i>N° {{$veto->TelVeto}}</label></div>
                    <div class="col-md-12"><label class="labels"> <i class="material-icons" style="font-size:30px;  vertical-align: bottom; margin-top: -.240ex; margin-right: 15px"> train</i> Moyen de transport ...</label></div>
                   
                </div>

                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Info pratique</label></div>
                    <div class="col-md-12"><label class="labels">Présentation</label></div>
        
                </div>
               
            </div>
            
        </div>
        
    </div>
</div>


@endsection