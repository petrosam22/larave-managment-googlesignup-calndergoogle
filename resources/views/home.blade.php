
<style>
.img{
    width: 50px;
    height: 50px;
    border-radius: 28px;

}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand text-dark fs-6" href="#">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-dark fs-6" aria-current="page" href="{{ route('notes') }}">Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark fs-6" aria-current="page" href="{{route('logout') }}">logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark fs-6" href="{{route('auth.google') }}">Signup With Googel</a>
        </li>


      </ul>
      @if(Auth::user())
      <form class="d-flex">

        <p>{{ Auth::user()->name }}</p>
    </form>
    @endif
    </div>





  </div>
</nav>

<div class="container">

    @yield('content')

</div>