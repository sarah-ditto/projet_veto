<!doctype html>
<html>
    <head>
        <title>@yield('title')</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="resources/css/welcome.css">
        <style type="text/css"> #welcome{position:relative}#form{position:absolute;top:40%;left:20%;background-color:rgba(229, 229, 229, 0.7);display:block;}</style>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <div class="border-bottom shadow-sm p-3 px-md-4 mb-3 bg-light">
            <div class="container align-items-center d-flex flex-column flex-md-row">
            <a href={{route('welcome.show')}}><img src="{{URL::asset('images/logo.png')}}" height="50" class="border rounded mr-2" alt="logo"></a>
                <h5 class="my-0 mr-md-auto font-weight-normal">@yield('title')</h5>

                @if (session()->has('user'))
                user ID :{{session()->get('user')[0]}} userType : {{session()->get('userType')}}
                    
                    <div class="dropdown" overflow="visible">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" 
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" 
                        aria-expanded="true" href="#"> Menu
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" 
                        style="position: absolute; will-change: transform; top: 0px;
                        left: 0px; transform: translate3d(0px, 38px, 0px);"
                        x-placement="bottom-start">
                        @if (session()->get('userType')==1)
                            <a class="dropdown-item" href= "{{route('bookedSlots.show')}}">Mon agenda</a>
                            <a class="dropdown-item" href="{{route('clientsList.show')}}">Mes clients</a>
                            <a class="dropdown-item" href="{{route('vetProfile.show', ['IDVeto'=>session()->get('user')])}}">Mes informations</a>
                            <a class="dropdown-item" href="{{route('createSlots.show')}}">Créer des créneaux</a>
                        @else
                            <a class="dropdown-item" href="{{route('appointments.show')}}">Mes rendez-vous</a>
                            <a class="dropdown-item" href="{{route('client.show',['IDClient'=>session()->get('user')])}}">Mes informations</a>
                            <a class="dropdown-item" href="{{route('createAnimal.show')}}">Ajouter un nouveau compagnon</a>
                        @endif
                        </div>
                    </div>
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="btn btn-outline-info">Déconnexion</a>
                </form>
                @else
                <div class="dropdown" overflow="visible">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" 
                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" 
                    aria-expanded="true" href="#"> Inscription
                    </button>
                
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" 
                    style="position: absolute; will-change: transform; top: 0px;
                    left: 0px; transform: translate3d(0px, 38px, 0px);"
                    x-placement="bottom-start">
                        <a class="dropdown-item" href="{{route('vetRegistration.show')}}" >Inscription Vétérinaire</a>
                        <a class="dropdown-item" href="{{route('clientRegistration.show')}}">Inscription Client</a>
                    </div>
                </div>
                <a class="btn btn-outline-info" href="/login">Connexion</a>
                @endif
            </div>
        </div>
        <div class="container mb-3">
            @yield('content')
        </div>
        <div class="border-top shadow-sm p-2 px-md-4 mt-auto bg-light">
        <footer class="page-footer font-small blue">
            <div class="footer-copyright text-center py-3">
                <a href={{route('about.show')}}> A propos </a> | <a href={{route('faq.show')}}> FAQ </a>
            </div>
        </footer>
        </div>
    </body>
    
</html>