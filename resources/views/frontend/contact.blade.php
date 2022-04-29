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
                <span>Nuestro</span><br>
                <span class="other-color">contacto</span>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid few-contact">
    <div class="row">

        <div class="col">
            <div class="contact-info-holder" style="text-align: center;">
                <div class="title">E-mail</div>
                <div class="contact-info"><a href="mailto:{{$datos->first()->email}}">{{$datos->first()->email}}</a></div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid box-content">
    <div class="row">
        <div class="col-md-6">
            <div class="boxy simple-data default-color">
                <div class="slg-text">
                    <span>CDMX</span>
                </div>
                <div class="normal-lg-text">
                    <p>Benito Juárez<br>
                        Locación 1</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="boxy simple-data c2-color">
                <div class="slg-text">
                    <span>CANCÚN</span>
                </div>
                <div class="normal-lg-text">
                    <p>Quintana Roo<br>
                       Locación 2</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid box-content">
    <div class="row">
        <div class="col-md-6">
            <div class="boxy simple-data c1-color">
                <div class="slg-text">
                    <span>Horario</span>
                </div>
                <div class="normal-lg-text">
                    <p>Lunes a Viernes <br>9:00am-18:00pm</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="boxy simple-data primary-color">
                <div class="slg-text">
                    <span>Renta VR</span>
                </div>
                <div class="normal-lg-text">
                    <p href="mailto:contacto@rentavr.com">contacto@rentavr.com.mx</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
@endsection