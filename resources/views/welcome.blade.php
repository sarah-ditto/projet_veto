@extends('base')

@section('title')
@endsection

@section('content')
<h4 class="text mt-5">Recherche par code postal</h4>
    <form class="form-inline" method="POST" action="{{route('zipSearchResult')}}">
    @csrf 
        <input type="text" class="form-control rounded" placeholder="Code postal" 
        aria-label="Search" aria-describedby="search-addon" name='codePostal' />
        <button type="submit" class="btn btn-outline-primary">Rechercher</button>
    </form> 
<h4 class="text mt-5">Recherche par nom d'un professionnel</h4>
    <form class="form-inline" method="POST" action=>
    @csrf
        <input type="text" class="form-control rounded" placeholder="Nom" aria-label="Search" aria-describedby="search-addon" />
        <button type="submit" class="btn btn-outline-primary">Rechercher</button>
    </form>
@endsection