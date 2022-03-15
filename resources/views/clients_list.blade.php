@extends('base')

@section('title')
Mes clients
@endsection

@section('content')
<table>
    <tr>
    @foreach($clients as $client)
        <td>{{$client->PrenomClient}} {{$client->NomClient}}</td>
        @foreach ($animals as $animal)
            @if ($client->IDClient==$animal->IDClient)
            <td><a href="{{route('Animal.show', ['IDAnimal'=>$animal->IDAnimal])}}">{{$animal->NomAnimal}}</a></td>
            @endif
        @endforeach
    </div>
    @endforeach
    </tr>
</table>
@endsection