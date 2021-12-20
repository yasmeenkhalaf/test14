<ul>
    @foreach($items as $menu_item)
        <li><a style="color: red;" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
    @endforeach
</ul>