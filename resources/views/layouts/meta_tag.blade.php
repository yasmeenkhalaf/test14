
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="@yield('meta_keyword')">
    <meta name="description" content="@yield('meta_description')">
    <link rel="icon" href="{{$meta['image']}}"/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{$meta['url']}}">
    <meta property="og:title" content="@yield('title_Page',$meta['title'])">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:image" content="{{$meta['image']}}">
    <!-- Twitter -->
    <meta property="twitter:card" content="{{$meta['image']}}">
    <meta property="twitter:url" content="{{$meta['url']}}">
    <meta property="twitter:title" content="@yield('title_Page',$meta['title'])">
    <meta property="twitter:description" content="@yield('meta_description')">
    <meta property="twitter:image" content="{{$meta['image']}}">
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{$meta['url']}}" />
    <title>@yield('title_Page',$meta['title'])</title>