<div class="main-menu">
    <div class="contant-info">
        <div><a href="mailto:contacto@peanut.agency">contacto@peanut.agency</a></div>
    </div>
    <div class="menu-links">
        <ul>
            <li><a href="/">Inicio</a></li>
            <li><a href="{{route('nosotros')}}">Nosotros</a></li>
            <li><a href="template/work.html">Proyectos</a></li>
            <li><a href="{{route('contacto')}}">Contacto</a></li>
        </ul>
    </div>
    <div class="social-media">
        <div class="social-link-holder"><a href="#">Instagram</a></div>
        <div class="social-link-holder"><a href="#">Facebook</a></div>
        <div class="social-link-holder"><a href="#">RentaVR</a></div>
    </div>
</div>

@php
 $logo= App\Models\BasicData::first()->image->getUrl();
@endphp
<nav class="container-fluid cnav">
    <div class="row">
        <div class="col">
            <div class="logo-holder">
                <a href="/"><img class="logo" src="{{$logo}}" alt="logo" style="width:200px;"></a>
            </div>
        </div>
        <div class="col text-right">
            <div class="social-media">
                <div class="social-link-holder"><a href="#">Instagram</a></div>
                <div class="social-link-holder"><a href="#">Facebook</a></div>
                <div class="social-link-holder"><a href="#">RentaVR</a></div>
            </div>
        </div>
    </div>
</nav>