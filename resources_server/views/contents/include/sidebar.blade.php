
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-sidebar-menu-closed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
             @foreach(Session::get('sidebar') as $key => $value)
                <li class="nav-item">
                    <a href=" {{ $value->url }}" class="nav-link ">
                         {!! $value->icon !!}
                        <span class="title">{{ $value->name }}</span>
                    </a>
                </li>               
            @endforeach
        </ul>
    </div>
</div>