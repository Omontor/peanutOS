@extends('layouts.mifront')
@section('content')

<div class="menu-toggle">
    <div class="icon"></div>
</div>
@include('partials.navmenu')
<header class="container-fluid header">
    <div class="row">
        <div class="col">
            <div class="lg-text">
                <span>Desarrollamos proyectos</span><br>
                <span>rentamos equipo</span><br>
                <span class="other-color">nosotros</span>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid process-section">
    <div class="row">
        <div class="col">
            <div class="lg-text"><span class="other-color">La agencia</span></div>
           	<div class="normal-text">
                <p>Somos una agencia digital dedicada al desarrollo de proyectos digitales.<br> Nuestras áreas de desarrollo son:</p>
            </div>
        </div>
    </div>
    <div class="row">
    	@forelse($categorias as $cat)
        <div class="col-md-4">
            <div class="text-box">
                <div class="title">{{$cat->name}}</div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>

<div class="container-fluid team-section">
    <div class="row">
        <div class="col">
            <div class="extra-lg-text">
                <span>nuestros</span><br>
                <span>clientes</span>
            </div>
        </div>
    </div>
    <div class="team-photos">
        <div class="team-photos-holder">

        	@forelse($clientes as $marcas)
        		<div class="photo-holder"><img src="{{$marcas->image->getUrl()}}" alt="" style="background-color: #000;"></div>
        	@empty
        	@endforelse

        </div>
    </div>
</div>

<div class="container-fluid jobs-section padding-for-team no-padding-bottom">
</div>

<div class="container-fluid other-content">
    <div class="row">
        <div class="col">
            <div class="lg-text">TRABAJEMOS JUNTOS</div>
            <div class="normal-text">
                <p>Contáctanos para poder crear el proyuecto que tienes en mente.</p>
            </div>
            <div class="btn-holder">
                <a href="#" class="cr-btn ex-padding">CONTACTO</a>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
@endsection