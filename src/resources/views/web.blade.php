<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LARAVEL Dark Documentation</title>
    <link rel="stylesheet" href="{{ asset('g4t/css/bootstrap.min.css') }}"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="{{ asset('g4t/js/axios.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('g4t/css/style.css') }}">
</head>

<body onload="checkToken()">



    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">
                <span class="laravel">LARAVEL</span><span class="title">
                    Dark Documentation
                </span>
            </a>
        </div>
    </nav>


    <div id="app">

        <div class="container">
            @foreach ($docs as $key => $doc)
                <div class="routes" id="accordion">
                    @include('documentation::form', ['route' => $doc, 'key' => $key])
                </div>
            @endforeach

        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Set Your Token
                    </h5>
                </div>
                <div class="modal-body">
                    <button type="button" id="logout" class="btn btn-method get-button w-100" onclick="setLogout()">
                        Logout
                    </button>
                    <input class="form-control" id="token" type="text" placeholder="Bearer Token" required />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="save" class="btn btn-method get-button" onclick="setToken()">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>





    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->

        <!-- Section: Social media -->



        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="https://github.com/hussein4alaa">HusseinAlaa</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->



    <script src="{{ asset('g4t/js/script.js') }}"></script>




    <script src="{{ asset('g4t/js/jquery-3.2.1.slim.min.js') }}"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="{{ asset('g4t/js/popper.min.js') }}"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="{{ asset('g4t/js/bootstrap.min.js') }}"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>
