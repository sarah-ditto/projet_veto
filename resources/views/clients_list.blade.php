@extends('base')

@section('title')
Mes clients
@endsection

@section('content')
<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th scope="col">Clients</th>
      <th scope="col">Animaux</th>
    </tr>
  </thead>

  <tbody>
    @foreach($clients as $client)
    <tr>
        <td><a href="{{route('client.show',['IDClient'=>$client->IDClient])}}">{{$client->NomClient}} {{$client->PrenomClient}}</a></td>
        <td>
        @foreach ($animals as $animal)
            @if ($client->IDClient==$animal->IDClient)
                <a href="{{route('animal.show', ['IDAnimal'=>$animal->IDAnimal, 'IDClient'=>$animal->IDClient ])}}">{{$animal->NomAnimal}}</a><br>
            @endif
        @endforeach
        </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection