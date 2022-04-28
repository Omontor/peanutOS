@extends('layouts.mifront')
@section('content')

<div class="menu-toggle">
    <div class="icon"></div>
</div>
	@include('partials.navmenu')

<header class="container-fluid header">
    <div class="mouse-scroll"></div>
    <div class="row">
        <div class="col">
            <div class="extra-lg-text">
                <span>desarrollamos</span><br>
                <span>creamos</span><br>
                <span>comunicamos</span><br>
                <span class="other-color">peanut agency</span>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid box-content">
    <div class="row">

        <div class="col-md-6">
            <div class="boxy c1-color">
                <div class="row">
                    <div class="col">
                        <h1 class="title">{{$categoria1->ultimo->first()->project->name}}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text">
                            {!!$categoria1->ultimo->first()->description!!}   
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="boxy img-box">
                <div class="img"><img src="{{$categoria1->ultimo->first()->thumb_image->getUrl()}}" alt="" style="object-fit: cover;"></div>
                <div class="bottom-text">
                    <div class="link">VER EL PROYECTO</div>
                    <div class="text">{{$categoria1->name}}</div>
                </div>
                <a href="template/project.html" class="project-link-full"></a>
            </div>
        </div>
        
    </div>
</div>

<div class="container-fluid box-content">
    <div class="row">
        <div class="col-md-6">
            <div class="boxy img-box">
                <div class="img"><img src="{{$categoria2->ultimo->first()->thumb_image->getUrl()}}" alt=""></div>
                <div class="bottom-text">
                    <div class="link">VER EL PROYECTO</div>
                    <div class="text">{{$categoria2->name}}</div>
                </div>
                <a href="template/project.html" class="project-link-full"></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="boxy primary-color">
                <div class="row">
                    <div class="col">
                        <h1 class="title">{{$categoria2->ultimo->first()->project->name}}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text">
                            {!!$categoria2->ultimo->first()->description!!}   
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid box-content">
    <div class="row">
        <div class="col-md-6">
            <div class="boxy default-color">
                <div class="row">
                    <div class="col">
                        <h1 class="title">{{$categoria3->ultimo->first()->project->name}}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text">
                            {!!$categoria3->ultimo->first()->description!!}   
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="boxy img-box">
                <div class="img"><img src="{{$categoria3->ultimo->first()->thumb_image->getUrl()}}" alt=""></div>
                <div class="bottom-text">
                    <div class="link">VER EL PROYECTO</div>
                    <div class="text">{{$categoria3->name}}</div>
                </div>
                <a href="template/project.html" class="project-link-full"></a>
            </div>
        </div>
    </div>
</div>

{{--<div class="container-fluid box-content">
    <div class="row">
        <div class="col-md-6">
            <div class="boxy img-box">
                <div class="img"><img src="{{$categoria4->ultimo->first()->thumb_image->getUrl()}}" alt=""></div>
                <div class="bottom-text">
                    <div class="link">VER EL PROYECTO</div>
                    <div class="text">{{$categoria4->name}}</div>
                </div>
                <a href="template/project.html" class="project-link-full"></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="boxy c2-color">
                <div class="row">
                    <div class="col">
                        <h1 class="title">{{$categoria4->ultimo->first()->project->name}}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text">
                            {!!$categoria4->ultimo->first()->description!!}   
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

 <div class="container-fluid box-content">
    <div class="row">
        <div class="col-md-6">
            <div class="boxy default-color">
                <div class="row">
                    <div class="col">
                        <h1 class="title">{{$categoria5->ultimo->first()->project->name}}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text">
                            {!!$categoria5->ultimo->first()->description!!}   
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="boxy img-box">
                <div class="img"><img src="{{$categoria5->ultimo->first()->thumb_image->getUrl()}}" alt=""></div>
                <div class="bottom-text">
                    <div class="link">VER EL PROYECTO</div>
                    <div class="text">{{$categoria5->name}}</div>
                </div>
                <a href="template/project.html" class="project-link-full"></a>
            </div>
        </div>
    </div>
</div>--}}

<div class="container-fluid box-content">
    <div class="row">
        <div class="col-md-6">
            <div class="boxy img-box">
                <div class="img"><img src="{{$categoria6->ultimo->first()->thumb_image->getUrl()}}" alt=""></div>
                <div class="bottom-text">
                    <div class="link">VER EL PROYECTO</div>
                    <div class="text">{{$categoria6->name}}</div>
                </div>
                <a href="template/project.html" class="project-link-full"></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="boxy c2-color">
                <div class="row">
                    <div class="col">
                        <h1 class="title">{{$categoria6->ultimo->first()->project->name}}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="text">
                            {!!$categoria6->ultimo->first()->description!!}   
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid default-content">
    <div class="row">
        <div class="col">
            <div class="lg-text">
                <span>AUGMENTED REALITY</span><br>
                <span>VIRTUAL REALITY</span><br>
                <span class="other-color">Y MUCHO MÁS...</span></div>
            <div class="normal-text">
                <p>Diseñamos experiencias de la mano de tu marca o empresa.<br>Podemos encontrar la mejor solución a tu necesidades.</p>
            </div>
            <div class="btn-holder">
                <a href="https://www.youtube.com/watch?v=qLJyqWoDVv0" target="_blank" class="cr-btn primary">NUESTRO REEL</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid clients-section">
    <div class="row">
        <div class="col">
            <div class="lg-text">
                <span>NUESTROS</span><br>
                <span>CLIENTES</span><br>
                </div>
            <div class="normal-text">
                <p>Algunas marcas y empresas con las que<br>hemos tenido la oportunidad de colaborar.</p>
            </div>
            <div class="clients-logos">
                <div class="logo-holder"><img src="template/images/brand1.png" alt=""></div>
                <div class="logo-holder"><img src="template/images/brand2.png" alt=""></div>
                <div class="logo-holder"><img src="template/images/brand3.png" alt=""></div>
                <div class="logo-holder"><img src="template/images/company2.png" alt=""></div>
                <div class="logo-holder"><img src="template/images/brand4.png" alt=""></div>
                <div class="logo-holder"><img src="template/images/company1.png" alt=""></div>
               
                <div class="logo-holder"><img src="template/images/company3.png" alt=""></div>
                <div class="logo-holder"><img src="template/images/company4.png" alt=""></div>
            </div>
        </div>
    </div>
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

