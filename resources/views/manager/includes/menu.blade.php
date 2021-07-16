<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
      @foreach($menus as $m)
        <li class="nav-item">
          <a class="nav-link" href="{{route($m->resource)}}">
            <span data-feather="file"></span>
            {{$m->name}}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</nav>