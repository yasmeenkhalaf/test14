<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <title><?php echo setting('site.title');?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                padding: 30px;
                margin: 0;
            }

            .full-height {
                
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
<header style="background-color: #000;">
                <div><img src="storage/{{ setting('site.logo') }}"></div>
                 
                <h1 style="color: #ffffff;">{{ setting('site.title') }}</h1>
        </header>             
                <ul class="navbar-nav ml-auto">
  <!-- Language switcher -->
  @foreach (app()->config->get('app.locales') as $key)
    <li>
      <a class="nav-link {{ app()->getLocale() === $key ? 'locale-active' : '' }}" href="{{ route('lang', $key) }}">
        {{ strtoupper($key) }}
      </a>
    </li>
  @endforeach
</ul>

<hr>
                <div><span>{{ setting('site.mobile') }}</span></div>
                <div><span>{{ setting('site.whatsapp') }}</span></div>
                <div><span>{{ setting('site.email') }}</span></div>
                @php menu('main', 'my_menu');@endphp
                <div class="links">
                    <a href="https://laravel.com/docs">الرئيسية</a>
                   
                    @foreach($pages as $page)
		 
				<a href="/page/{{ $page->slug }}">
                @php echo $page->getTranslatedAttribute('title', 'locale', Config::get('app.locale'));  @endphp
					
				</a>
		 
		@endforeach
                    
                    <a href="https://laravel-news.com">خدماتنا</a>
                    <a href="https://blog.laravel.com">مقالات</a>
                    <a href="https://nova.laravel.com">تواصل معنا</a>
                   
                </div>

                <hr>
                <!-- ---------------- start slider -------------------------------- -->
                

                <div class="slideshow-container">
                @foreach($slides as $slide)
                <div class="mySlides fade">
   <img src="storage/{{$slide->image}}" style="width:100%">
  <div class="text">
  @php echo $slide->getTranslatedAttribute('title', 'locale', Config::get('app.locale'));  @endphp
<br>
@php echo $slide->getTranslatedAttribute('subtitle', 'locale', Config::get('app.locale'));  @endphp


</div>
 

</div>
                 @endforeach
 
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
 </div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>



<!-- --------------- end slider ------------------------------------------- -->






                <hr>
              

                <div class="row" style="display: flex;">
                <div class="col-lg-6" style="width: 50%;">
                <div style="display: flex;">
 @if($page->images)
  @foreach (json_decode($page->images, true) as $image)
  <img src="storage\{{ $image }}" class=" mb-3 w-100 img-responsive center-block">
  @endforeach
  @endif
  </div></div>
  <div class="col-lg-6" style="width: 50%;">
                <h3> @php echo $page->getTranslatedAttribute('title', 'locale', Config::get('app.locale'));  @endphp</h3>
                 <p>@php echo $page->getTranslatedAttribute('excerpt', 'locale', Config::get('app.locale'));  @endphp </p>
                </div>

        </div>

            </div>






        </div>




        <hr>

<div style="width: 100%;">
    <div>
        <h1  style="width: 100%; text-align: center;">خدماتنا</h1>
</div>
<div style="display: flex; width: 100%;" class="row"> 
@if($services)
  @foreach ($services as $service)
 <div style="" class="col-lg-3 col-sm-3">
 <img src="storage/{{$service->image}}" style="width: 100%; margin: 10px;">
 <h6>@php echo $service->getTranslatedAttribute('title', 'locale', Config::get('app.locale'));  @endphp</h6>
</div>
  @endforeach
  @endif
</div>
</div>    

<hr>

<div>
    <h1  style="width: 100%; text-align: center;">الشهادات والتوصيات</h1>
@if($testimonials)
  @foreach ($testimonials as $testimonial)
 <div style="display: flex;" class="">
<div>
<h6>@php echo $testimonial->getTranslatedAttribute('name', 'locale', Config::get('app.locale'));  @endphp</h6>
<p>@php echo $testimonial->getTranslatedAttribute('content', 'locale', Config::get('app.locale'));  @endphp</p>
<p>@php echo $testimonial->getTranslatedAttribute('position', 'locale', Config::get('app.locale'));  @endphp</p>
</div>
<img src="storage/{{$testimonial->image}}" style="width: 300px; margin: 10px;">

</div>
  @endforeach
  @endif
</div>

<hr>




<div>
    <h1 style="width: 100%; text-align: center;">مقالات</h1>
@if($posts)
  @foreach ($posts as $post)
 <div style="display: flex;" class="">
<div>
<h6>@php echo $post->getTranslatedAttribute('title', 'locale', Config::get('app.locale'));  @endphp</h6>
<p>@php echo $post->getTranslatedAttribute('excerpt', 'locale', Config::get('app.locale'));  @endphp</p>
<p>@php echo $post->getTranslatedAttribute('created_at', 'locale', Config::get('app.locale'));  @endphp</p>
</div>
<img src="storage/{{$post->image}}" style="width: 300px; margin: 10px;">

</div>
  @endforeach
  @endif   
</div>










    </body>
</html>
