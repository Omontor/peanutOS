<footer class="container-fluid footer">
@php
 $logo= App\Models\BasicData::first()->image->getUrl();
 $email= App\Models\BasicData::first()->email;
@endphp
    <div class="row">
        <div class="col">
            <div class="lg-text">
                <span>100% satisfication.</span><br>
                <span>let’s create</span>
            </div>
            <div class="normal-text">
                <p>We’ll take your business to the next level, with our proven<br>strategies, latest technologies and friendly creatives that<br>will work to produce the best outcome possible.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="contact-info-holder">
                <div class="title">NOSOTROS</div>
                <br>
                <img src="template/images/LogoNuevobCO.gif" alt="" style="width:200px; object-fit: contain;"> 
                <br><br>
                <img src="template/images/logobco.png" alt="" style="width:100px; object-fit: contain;">
                <br><br>
            </div>
        </div>

        <div class="col">
            <div class="contact-info-holder">
                <div class="title">E-mail</div>
                <div class="contact-info"><a href="mailto:{{$email}}">{{$email}}</a></div>
                <div class="social-media">
                        <div class="social-link-holder"><a href="#">Instagram</a></div>
                        <div class="social-link-holder"><a href="#">Facebook</a></div>
                        <div class="social-link-holder"><a href="#">RentaVR</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>