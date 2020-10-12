<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:orange;">
  <a class="navbar-brand" href="{{'/home'}}"><span style="font-size:30px">BAMZ</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" >
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{'/home'}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{'/shop'}}">Shop</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <? $cat = DB::table('categories')->get() ?>
        @foreach($cat as $cats)
          <a class="dropdown-item" href="{{url('category',$cats->id)}}">{{$cats->name}}</a>
          @endforeach
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/wishlist')}}">Wishlist
        @if(App\wishlist_model::count()>0)
      <span class="badge badge-dark">{{App\wishlist_model::count()}}</span>
      @endif
        </a>
      </li>
      <?php if(Auth::check()){?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="">{{Auth::user()->name}}</a>
          <a class="dropdown-item" href="{{ route('user.logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
          <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
        </div>
        <li>
      <?php }else{?>
        <a class="nav-link" href="{{url('/login')}}">Login</a>
      <?php }?>
      <li class="nav-item">
      <a class="nav-link" href="{{url('/cart')}}">Cart 
      @if($cart->count()>0)
      <span class="badge badge-dark">{{$cart->count()}}</span>
      @endif
      </a>
      </li>
    </ul>
  </div>
</nav>
