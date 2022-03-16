@extends('base')

@section('title')
Vétérinaires
@endsection


@section('content')
    <div>
    @foreach($vetos as $veto)
        <div class="col-md-10 border-top ">
        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">

          <div style="margin-left: 200px;">
          <div> <a href="{{route('vetProfile.show', ['IDVeto'=>$veto->IDVeto])}}"> Docteur {{$veto->PrenomVeto}} {{$veto->NomVeto}}</a> </div>
           <div>Mail  {{$veto->MailVeto}}  </div>
           <div>Adresse  {{$veto->NumRueVeto}} {{$veto->NomRueVeto}}</div>
           <div>Creneau disponible :  
        <table border="2"> 
               @foreach($creneaux as $creneau)
                @if($creneau-> IDVeto == $veto->IDVeto)
                    <tr>
            
                        <td class="col-md-10 border-top "><a href="{{route('confirmSlot.show', ['IDCreneau'=>$creneau->IDCreneau])}}"> {{$creneau->DateCreneau}} </a></td>

                    </tr>
                    @endif
                @endforeach
               </table>
            </div>
            </span> 
        </div>
        <div class="row mt-3">
        </div>
    @endforeach
</div>
@endsection

