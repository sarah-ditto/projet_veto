@extends('base')

@section('title')
@endsection

@section('content')
<h4 class="text mt-5">Recherche par code postal</h4>
<form class="form-inline" method="POST" action="{{route('zipSearchResult')}}">
@csrf
    <div>
      <input type="text" id="codePostal" name="codePostal" placeholder="Code postal" value="{{old('codePostal')}}"
             aria-describedby="codePostal_feedback" class="form-control @error('codePostal') is-invalid @enderror"> 
      <button type="submit" class="btn btn-outline-primary">Rechercher</button>
      @error('codePostal')
      <div id="codePostal_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
</form> 

<h4 class="text mt-5">Recherche par code postal nom d'un professionnel</h4>
<form class="form-inline" method="POST" action="{{route('nameSearchResult')}}">
@csrf
    <div>
      <input type="text" id="nom" name="nom" placeholder="Nom" value="{{old('nom')}}"
             aria-describedby="nom_feedback" class="form-control @error('nom') is-invalid @enderror"> 
      <button type="submit" class="btn btn-outline-primary">Rechercher</button>
      @error('nom')
      <div id="nom_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
</form> 
@endsection