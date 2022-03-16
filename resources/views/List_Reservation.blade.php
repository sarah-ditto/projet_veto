@extends('base')

@section('title')
Mes Rendez-Vous 
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

       
            <div class="p-3 py-5" >
                <div class="d-flex justify-content-between align-items-center mb-3"></div>
                <div class="row mt-2">
                    <div class="col-md-12"> 
                    <table > 
                    <tr style="font-size: 20px;"   class="col-md-10">
                        
                        <td  class="col-md-10 border-top " > Date et heure </td>
                        <td class="col-md-10 border-top "> Motif</td>
                        <td class="col-md-10 border-top "> Client</td>
                        <td class="col-md-10 border-top "> Animal</td>

                    </tr>
                    
                            @foreach($consultation as $consult )
                            
                                <tr>
                                    
                                    <td class="col-md-10 border-top "> {{$consult->DateCreneau}}</td>
                                    <td class="col-md-10 border-top "> {{$consult->MotifConsult}} </td>
                                    <td class="col-md-10 border-top "> {{$consult->NomClient}} {{$consult->PrenomClient}} </td>
                                    <td class="col-md-10 border-top "> <a href="{{route('Animal.show', ['IDAnimal'=>$consult->IDAnimal])}}">{{$consult->NomAnimal}}</a></td>
                                </tr>
                            @endforeach
                    </table>   
                    </div>
                   
                </div>
                
               
            </div>
        
    </div>
</div>


@endsection
