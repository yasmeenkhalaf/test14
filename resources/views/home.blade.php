@extends('layouts.app')

@section('meta_keyword',$meta['keywords'])
@section('meta_description',$meta['description'])

@section('title_Page',$meta['title'])

 

 
@section('body')

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
               

 <div><img src="{{getImage(setting('site.logo'),null)}}"></div>
 

                <h1 style="color: #ffffff;">{{ setting('site.title') }}</h1>
        </header>  
        
        <div class="lang-div mt-2">
            <label class="w-100">
                <span class="lang-select-arrow"></span>
                <select class="lang-select text-center menu-nav-link w-100">
                    <option value="{{ route('language','en') }}" {{$lang =='en'?'selected':''}}>ENGLISH</option>
                    <option value="{{ route('language','ar') }}" {{$lang =='ar'?'selected':''}}>العربية</option>
                </select>
            </label>

<a href="{{ route('language','en') }}">ENGLISH</a>
<a href="{{ route('language','ar') }}">العربية</a>


        </div>

    
<hr>
                <div><span>{{ setting('site.mobile') }}</span></div>
                <div><span>{{ setting('site.whatsapp') }}</span></div>
                <div><span>{{ setting('site.email') }}</span></div>
                @php menu('main', 'my_menu');@endphp
                <div class="links">
                    <a href="https://laravel.com/docs">{{__('main.home')}}</a>
                   
                    @foreach($pages as $page)
		 
				<a href="page/{{ $page->slug }}">
                @php echo $page->getTranslatedAttribute('title', 'locale', Config::get('app.locale'));  @endphp
					
				</a>
		 
		@endforeach
                    
                    <a href="https://laravel-news.com">خدماتنا</a>
                    <a href="posts">مقالات</a>
                    <a href="https://nova.laravel.com">تواصل معنا</a>
                   
                </div>

                <hr>
                <!-- ---------------- start slider -------------------------------- -->
                

                <div class="slideshow-container">
                @foreach($slides as $slide)
                <div class="mySlides fade">
   <img src="{{getImage($slide->image,null)}}" style="width:100%">
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




<!-- --------------- end slider ------------------------------------------- -->






                <hr>
              

                <div class="row" style="display: flex;">
                <div class="col-lg-6" style="width: 50%;">
                <div style="display: flex;">
 @if($page->images)
  @foreach (json_decode($page->images, true) as $image)
  <img src="{{getImage($image,null)}}" class=" mb-3 w-100 img-responsive center-block">
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
 <img src="{{getImage($service->image,null)}}" style="width: 100%; margin: 10px;">
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
<img src="{{getImage($testimonial->image,null)}}" style="width: 300px; margin: 10px;">

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
<img src="{{getImage($post->image,null)}}" style="width: 300px; margin: 10px;">

</div>
  @endforeach
  @endif   
</div>










    </body>
    @endsection
