@extends('base')

@section('title')
Créneaux
@endsection

@section('content')

<table>
    @foreach($vetos as $veto)
        <tr>
           <td> Docteur {{$veto->PrenomVeto}} {{$veto->NomVeto}} </td>
            <td> 
            <table>
               @foreach($creneaux as $creneau)
               @if($creneau->IDVeto == $veto->IDVeto)
                <tr>

                    <td> {{$creneau->DateCreneau}} </td>

                </tr>
                @endif
               @endforeach
               </table>

            </td>
        </tr>
    @endforeach
    </table> 
    @endsection