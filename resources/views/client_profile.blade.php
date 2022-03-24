@extends('base')

@section('title')
Profil et compagnons
@endsection

@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Informations</h4>
                </div>
                <div class="row mt-3">
                <span class="material-icons mr-2">person</span>{{$client->PrenomClient}} {{$client->NomClient}}
                </div>
                <div class="row mt-3">
                <span class="material-icons mr-2">cottage</span>{{$client->NumRueClient}} {{$client->NomRueClient}} {{$client->CodePostalClient}} {{$client->Ville}}
                </div>
                <div class="row mt-3">
                    <span class="material-icons mr-2">phone</span>{{$client->TelClient}}
                </div>
                <div class="row mt-3">
                    <span class="material-icons mr-2">mail</span>{{$client->MailClient}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Compagnons</h4>
                </div>
                    @foreach($animaux as $animal)
                    <div class="mt-3"><span class="material-icons mr-2">pets</span><a href="{{route('animal.show', ['IDAnimal'=>$animal->IDAnimal, 'IDClient'=>$animal->IDClient ])}}"> {{$animal->NomAnimal}}</a></div>
                    @endforeach
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection