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
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"><b>Prenom</b></label> {{$client->PrenomClient}}<br></div>
                    <div class="col-md-6"><label class="labels"><b>Nom</b></label> {{$client->NomClient}} <br></div>
                </div>
                <div class="row mt-3">
                <div class="col-md-12"><label class="labels"> <i class="material-icons" style="font-size:30px;  vertical-align: bottom"> local_phone</i>N° {{$client->TelClient}}<br></div>
                <div class="col-md-12"><label class="labels"> <i class="material-icons" style="font-size:30px;  vertical-align: bottom; margin-top: -.240ex; margin-bottom:-15px; margin-right: 10px"> location_city </i></label> {{$client->NumRueClient}} {{$client->NomRueClient}}</div>
                <div class="col-md-12"><label class="labels" style="margin-left:42px"> {{$client->CodePostalClient}}</div>
                    <div class="col-md-12"><label class="labels"><b>Email</b></label> {{$client->MailClient}}<br></div>
                </div>
        </div>
    </div>
    
        <h4 class="text-right">Compagnons</h4>
                <table>
                    @foreach($animaux as $animal)
                <tr>
                    <td><a href="{{route('animal.show', ['IDAnimal'=>$animal->IDAnimal, 'IDClient'=>$animal->IDClient ])}}"> {{$animal->NomAnimal}}</a></td>
                </tr>
                    @endforeach
                </table> 
</div>
</div>
</div>




@endsection