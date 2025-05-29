<div class="parent-container menu-container">
    <div>
        @isset($logo)
        <img src="{{ asset('storage/' .$logo->logoimg) }}" alt="Logo" width="100" loading="eager">

    @endisset
    </div>
    <div class="menu-container">
        <ul class="menu-list-style">
            @isset($menus)
                @foreach ($menus as $menuitem)
                    <li class="menu-list">
                        <a href="{{ $menuitem->url }}" class="anchor">{{ $menuitem->name }}</a>
                    </li>
                @endforeach
            @endisset
        </ul>
    </div>

    <div class="user-action">
        <div class="icon-container"><a href="#"><img src="{{asset('images/whis-list.png')}}" alt="none"></a></div>
        <div class="icon-container"><a href="#"><img src="{{asset('images/add-to-cart.png')}}" alt="none"></a></div>
        
    </div>
     
</div>