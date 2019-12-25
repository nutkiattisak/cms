<div class="sidebar">
    <div class="sidebar-wrapper">
      <div class="logo">
        <a href="javascript:void(0)" class="simple-text logo-mini">

        </a>
        <a href="javascript:void(0)" class="simple-text logo-normal">
           {{ config('app.name', 'Laravel') }}
        </a>
      </div>
      <ul class="nav">
        <li>
          <a href="{{route('posts.index')}}">
            <i class="tim-icons icon-chart-pie-36"></i>
            <p>Posts</p>
          </a>
        </li>
        <li>
          <a href="{{route('categories.index')}}">
            <i class="tim-icons icon-atom"></i>
            <p>Categories</p>
          </a>
        </li>
        
      </ul>
    </div>
  </div>