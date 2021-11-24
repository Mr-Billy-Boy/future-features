@extends('layouts.app')

@section('title', 'Login')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Future Feature</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
            </ul>
            <div class="d-flex">
                <button class="btn btn-outline-dark" href="#" onclick="signOut();">Sign Out</button>
            </div>
        </div>
    </div>
</nav>

<div>
    
</div>

@endsection

@section('js')
    <script>
        
    </script>
@endsection