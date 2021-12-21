<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!--  Meta Tag -->
@include('layouts.meta_tag')

<!-- Styles -->

    <!-- Jquery & Bootstrap-->
   
    <link rel="stylesheet" href="{{asset('assets/css/components/main.css')}}">
    @if(app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{asset('assets/css/main-rtl.css')}}">
@endif
 


    @yield('style')
    <!--  used if each single page has its own style.css file , it should be included here  -->

<!-- End Style -->


    <!-- Fonts -->

    <!--  Please Add Fonts link here  -->
    @yield('fonts')


<!-- End Fonts -->


    @if(config("app.Google_Analytics_ID")!=null)
    <!-- Google Analytics -->
        @include('layouts.google_analytics')
    <!--  End Google Analytics -->
    @endif

    <!-- Global site tag (gtag.js) - Google Analytics -->
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


</head>
<body>

@include('layouts.navbar')

@yield('body')



@include('layouts.footer')




{{--@if(config("app.Accessible_Tools")==true)
    <!-- Accessible JS -->
    <script src="{{asset('assets/plugins/accessible/open-accessibility.min.js')}}"></script>
    <script>
        $('html').openAccessibility({
            localization: ['{{app()->getLocale()}}'],
            isMobileEnabled: true,


        });

    </script>
    <!-- End Accessible JS -->
@endif--}}

@if(config("app.Google_Map_Key")!=null)
    <!-- Google Map -->
    @include('layouts.google_map')
    <!--  End Google Map -->
@endif


</body>
</html>