<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo setting('site.title');?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
      
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


            <div><img src="./storage/{{ setting('site.logo') }}"></div>
                <div class="title m-b-md">
                {{ setting('site.title') }}
                </div>


            @if($posts)
            @foreach($posts as $post)
              
             
                       @if(!empty($post->image))
                            <img src="./storage/{{$post->image}}" class="w-100 h-100" alt="news">
                        @endif
                         <a href="post/{{ $post->slug }}"><h1>@php echo $post->getTranslatedAttribute('title', 'locale', Config::get('app.locale'));  @endphp
</h1></a>
                        @if(!empty($post->excerpt))
                          <p>  @php echo $post->getTranslatedAttribute('excerpt', 'locale', Config::get('app.locale'));  @endphp</p>
                        @endif

                        
                  @endforeach
                  @endif             

                
                <div>
                
                </div>
 


            </div>
        </div>
    </body>
</html>
