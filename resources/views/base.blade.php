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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <style type="text/css">
        #welcome {
            position: relative
        }

        #form {
            position: fixe;
            top: 40%;
            left: 20%;
            background-color: rgba(229, 229, 229, 0.7);
            display: block;
            position: fixed;
            z-index: 2;
            border-radius: 75%;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="border-bottom shadow-sm p-3 px-md-4 mb-3 " style="background-color:#D1E4E7 ">
        <div class="container align-items-center d-flex flex-column flex-md-row">
            <a href={{route('welcome.show')}}><img src="{{URL::asset('images/logo.png')}}" height="50" class="border rounded mr-6" alt="logo"></a>
            <h5 class="my-0 mr-md-auto font-weight-normal">@yield('title')</h5>

            @if (session()->has('user'))
            <!-- user ID :{{session()->get('user')[0]}} userType : {{session()->get('userType')}} -->

            <div class="dropdown" overflow="visible">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#"> Menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; will-change: transform; top: 0px;
                        left: 0px; transform: translate3d(0px, 38px, 0px);" x-placement="bottom-start">
                    @if (session()->get('userType')==1)
                    <a class="dropdown-item" href="{{route('bookedSlots.show')}}">Mon agenda</a>
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
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#"> Inscription
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="position: absolute; will-change: transform; top: 0px;
                    left: 0px; transform: translate3d(0px, 38px, 0px);" x-placement="bottom-start">
                    <a class="dropdown-item" href="{{route('vetRegistration.show')}}">Inscription Vétérinaire</a>
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




    <!-- Footer -->
    <footer class="bg-dark text-center mt-auto text-white">
        <!-- Grid container -->
        <div class="container p-1 pb-0">
            <!-- Section: Links -->
            <section class="">
                <!--Grid row-->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-sm-left">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            CCI
                        </h6>
                        <p>
                            Le site pour trouver votre vétérinaire et prendre rendez-vous en ligne.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold"> <a style="color:grey;" href={{route('about.show')}}> A propos </a></h6>
                    </div>
                    <!-- Grid column -->

                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold"> <a style="color:grey;" href={{route('faq.show')}}> FAQ </a></h6>
                    </div>

                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 text-justify">
                        <h6 class="text-uppercase mb-4 font-weight-bold text-center">Contact</h6>
                        <p><i class="fa fa-home mr-3"></i> Marseille, 163 Av. de Luminy</p>
                        <p><i class="fa fa-envelope mr-3"></i> CCI@gmail.com</p>
                        <p><i class="fa fa-phone mr-3"></i> + 033 06 77 90 02 64</p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Nous suivre </h6>
                        <!-- Github -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="https://github.com/sarah-ditto/projet_veto.git" role="button"><i style="font-size:50px" aria-hidden="true" class='fa fa-github blue-color'></i>
                            ></a>
                    </div>
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-1" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2022 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">Master CCI</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>