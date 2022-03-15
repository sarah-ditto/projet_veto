@extends('base')

@section('title')
Votre Profil et vos compagnons
@endsection

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Vos Informations</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"><b>Prenom</b></label> {{$client->PrenomClient}}<br></div>
                    <div class="col-md-6"><label class="labels"><b>Nom</b></label> {{$client->NomClient}} <br></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels"><b>Numéro de téléphone</b></label> {{$client->TelClient}}<br></div>
                    <div class="col-md-12"><label class="labels"><b>Adresse</b></label> {{$client->NumRueClient}} {{$client->NomRueClient}}</div>
                    <div class="col-md-12"><label class="labels"><b>Code Postale</b></label> {{$client->CodePostalClient}}</div>
                    <div class="col-md-12"><label class="labels"><b>Email</b></label> {{$client->MailClient}}<br></div>
                </div>
        </div>
    </div>
                <h4 class="text-right">Vos Compagnons</h4>
                <table>
                    @foreach($animaux as $animal)
                <tr>
                    <td><a href="{{route('Animal.show', ['IDAnimal'=>$animal->IDAnimal])}}"> {{$animal->NomAnimal}}</td>
                </tr>
                    @endforeach
                </table> 
</div>
</div>
</div>




@endsection