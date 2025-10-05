<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- <link rel="shortcut icon" href="images/favicon.ico"> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Scripts -->
<!-- Fonts -->

<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css" />

<link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<!-- CSS Files -->

<link rel="icon" href="{{ asset('images/favicon.ico') }}" />


<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<link
    href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.3.4/af-2.7.1/b-3.2.5/b-colvis-3.2.5/b-html5-3.2.5/b-print-3.2.5/cr-2.1.1/cc-1.1.0/r-3.0.7/datatables.min.css"
    rel="stylesheet" integrity="sha384-9Ln0JbzQymIlMhjyLlbJxVhMn5jWVs13ruB/EighnnY0TLh35Pj2PJZPPQmdU4Zu"
    crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

{{-- Select2 - MultiSelect --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- Basic text editor --}}
<!-- include summernote css/js-->


<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@stack('css')

<style>
    .login-container {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        width: 400px;
    }

    .login-container .btn {
        width: 100%;
        margin-bottom: 10px;
    }

    .form-control {
        margin-bottom: 20px;
    }

    html,
    body {
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    #preloader {
        position: fixed;
        inset: 0;
        z-index: 999999;
        overflow: hidden;
        background: #ffffff;
        transition: all 0.6s ease-out;
    }

    #preloader:before {
        content: "";
        position: fixed;
        top: calc(50% - 30px);
        left: calc(50% - 30px);
        border: 6px solid #ffffff;
        border-color: #b13124 transparent #b13124 transparent;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: animate-preloader 1.5s linear infinite;
    }

    @keyframes animate-preloader {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
