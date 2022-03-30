@extends('base')

@section('title')
Inscription Client
@endsection

@section('content')
<form method="POST" action="{{route('clientRegistration.post')}}">
  @csrf
  @if ($errors->any())
  <div class="alert alert-warning">
    Votre inscription n'a pas pu être prise en compte &#9785;
  </div>
  @endif
  <div class="form-group">
    <label for="MailClient">E-mail</label>
    <input type="email" id="MailClient" name="MailClient" value="{{old('MailClient')}}" aria-describedby="MailClient_feedback" class="form-control @error('MailClient') is-invalid @enderror">
    @error('MailClient')
    <div id="MailClient_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="NomClient">Nom</label>
    <input type="text" id="NomClient" name="NomClient" value="{{old('NomClient')}}" aria-describedby="NomClient_feedback" class="form-control @error('NomClient') is-invalid @enderror">
    @error('NomClient')
    <div id="NomClient_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="PrenomClient">Prénom</label>
    <input type="text" id="PrenomClient" name="PrenomClient" value="{{old('PrenomClient')}}" aria-describedby="PrenomClient_feedback" class="form-control @error('PrenomClient') is-invalid @enderror">
    @error('PrenomClient')
    <div id="PrenomClient_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="TelClient">Téléphone</label>
    <input type="text" id="TelClient" name="TelClient" value="{{old('TelClient')}}" aria-describedby="TelClient_feedback" class="form-control @error('TelClient') is-invalid @enderror">
    @error('TelClient')
    <div id="TelClient_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="NumRueClient">N°</label>
    <input type="number" id="NumRueClient" name="NumRueClient" value="{{old('NumRueClient')}}" aria-describedby="NumRueClient_feedback" class="form-control @error('NumRueClient') is-invalid @enderror">
    @error('NumRueClient')
    <div id="NumRueClient_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="NomRueClient">Rue</label>
    <input type="text" id="NomRueClient" name="NomRueClient" value="{{old('NomRueClient')}}" aria-describedby="NomRueClient_feedback" class="form-control @error('NomRueClient') is-invalid @enderror">
    @error('NomRueClient')
    <div id="NomRueClient_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="CodePostalClient">Code postal</label>
    <input type="text" id="CodePostalClient" name="CodePostalClient" value="{{old('CodePostalClient')}}" aria-describedby="CodePostalClient_feedback" class="form-control @error('CodePostalClient') is-invalid @enderror">
    @error('CodePostalClient')
    <div id="CodePostalClient_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="CodePostalClient">Ville</label>
    <input type="text" id="Ville" name="Ville" value="{{old('Ville')}}" aria-describedby="Ville_feedback" class="form-control @error('Ville') is-invalid @enderror">
    @error('Ville')
    <div id="Ville_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="MdpClient">Mot de passe</label>
    <input type="password" id="MdpClient" name="MdpClient" value="{{old('MdpClient')}}" aria-describedby="MdpClient_feedback" class="form-control @error('MdpClient') is-invalid @enderror">
    @error('MdpClient')
    <div id="MdpClient_feedback" class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
@endsection