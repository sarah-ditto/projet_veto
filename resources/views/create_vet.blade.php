@extends('base')

@section('title')
Inscription Vétérinaire
@endsection

@section('content')
<form method="POST" action="{{route('vetRegistration.post')}}">
@csrf
@if ($errors->any())
    <div class="alert alert-warning">
        Votre inscription n'a pas pu être prise en compte &#9785;
    </div>
@endif
    <div class="form-group">
      <label for="MailVeto",>E-mail</label>
      <input type="email" id="MailVeto" name="MailVeto" value="{{old('MailVeto')}}"
             aria-describedby="MailVeto_feedback" class="form-control @error('MailVeto') is-invalid @enderror"> 
      @error('MailVeto')
      <div id="MailVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="NomVeto">Nom</label>
      <input type="text" id="NomVeto" name="NomVeto" value="{{old('NomVeto')}}"
             aria-describedby="NomVeto_feedback" class="form-control @error('NomVeto') is-invalid @enderror"> 
      @error('NomVeto')
      <div id="NomVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="PrenomVeto">Prénom</label>
      <input type="text" id="PrenomVeto" name="PrenomVeto" value="{{old('PrenomVeto')}}"
             aria-describedby="PrenomVeto_feedback" class="form-control @error('PrenomVeto') is-invalid @enderror"> 
      @error('PrenomVeto')
      <div id="PrenomVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="TelVeto">Téléphone</label>
      <input type="text" id="TelVeto" name="TelVeto" value="{{old('TelVeto')}}"
             aria-describedby="TelVeto_feedback" class="form-control @error('TelVeto') is-invalid @enderror"> 
      @error('TelVeto')
      <div id="TelVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="NumRueVeto">N°</label>
      <input type="number" id="NumRueVeto" name="NumRueVeto" value="{{old('NumRueVeto')}}"
             aria-describedby="NumRueVeto_feedback" class="form-control @error('NumRueVeto') is-invalid @enderror"> 
      @error('NumRueVeto')
      <div id="NumRueVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="NomRueVeto">Rue</label>
      <input type="text" id="NomRueVeto" name="NomRueVeto" value="{{old('NomRueVeto')}}"
             aria-describedby="NomRueVeto_feedback" class="form-control @error('NomRueVeto') is-invalid @enderror"> 
      @error('NomRueVeto')
      <div id="NomRueVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="CodePostalVeto">Code postal</label>
      <input type="text" id="CodePostalVeto" name="CodePostalVeto" value="{{old('CodePostalVeto')}}"
             aria-describedby="CodePostalVeto_feedback" class="form-control @error('CodePostalVeto') is-invalid @enderror"> 
      @error('CodePostalVeto')
      <div id="CodePostalVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="Ville">Ville</label>
      <input type="text" id="Ville" name="Ville" value="{{old('Ville')}}"
             aria-describedby="Ville_feedback" class="form-control @error('Ville') is-invalid @enderror"> 
      @error('Ville')
      <div id="Ville_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="PresentationVeto">Présentation</label>
      <input type="text" id="PresentationVeto" name="PresentationVeto" value="{{old('PresentationVeto')}}"
             aria-describedby="PresentationVeto_feedback" class="form-control @error('PresentationVeto') is-invalid @enderror"> 
      @error('PresentationVeto')
      <div id="PresentationVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="form-group">
      <label for="PresentationVeto">Animaux que vous prenez en charge : </label><br>
      <input type="checkbox" id="APEC_Chat" name="chat" value="Chat">
        <label for="APEC_Chat"> Chat</label><br>
        <input type="checkbox" id="APEC_Chien" name="chien" value="Chien">
        <label for="APEC_Chien"> Chien</label><br>
        <input type="checkbox" id="APEC_NAC" name="nac" value="NAC">
        <label for="APEC_NAC"> NAC</label><br>
        <input type="checkbox" id="APEC_animal_rural" name="animal_rural" value="Animal Rural">
        <label for="APEC_animal_rural"> Animal Rural</label><br>
    </div>

    <div class="form-group">
      <label for="MdpVeto">Mot de passe</label>
      <input type="password" id="MdpVeto" name="MdpVeto" value="{{old('MdpVeto')}}"
             aria-describedby="MdpVeto_feedback" class="form-control @error('MdpVeto') is-invalid @enderror">  
      @error('MdpVeto')
      <div id="MdpVeto_feedback" class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
@endsection