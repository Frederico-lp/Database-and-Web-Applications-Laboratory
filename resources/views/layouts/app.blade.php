<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
</script>
  </head>
  <body>
    <main>
      <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/home') }}">      
            <img src= "/images/logo.png" width="200" height="100"> </a>
        
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor03">
              <ul class="navbar-nav me-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{ url('/home') }}">Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/faq') }}">FAQ</a>
                </li>
                @if (Auth::check())
                  @if (Auth::user()->isadmin == "True")
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin Options</a>
                    <div class="dropdown-content">
                        <a class="dropdown-item" href="/api/books/addBook"> Add Book </a> 
                        <a class="dropdown-item" href="/admin/users"> Check Accounts </a>                        
                    </div>
                  </li>
                  @endif
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <div class="dropdown-content">
                        <a class="dropdown-item" href="/user/{{Auth::user()->id}}"> Account </a>
                                  
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/logout') }}"> Logout </a>                          
                    </div>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" id = "notification" href="/users/{{Auth::user()->id}}/notifications"> <img src = "https://uxwing.com/wp-content/themes/uxwing/download/37-communication-chat-call/notification-bell.png" width="20" height="20"> </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="/users/{{Auth::user()->id}}/wishlist"> <img src= "https://www.iconpacks.net/icons/1/free-heart-icon-492-thumb.png" width="20" height="20"> </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/users/{{Auth::user()->id}}/cart"> <img src="https://cdn-icons-png.flaticon.com/512/263/263142.png" width="20" height="20"> </a> 
                  </li>
              
                @else
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}">Log in</a>
                  </li>

                @endif
              </ul>
              
              <form class="d-flex" action="/search/3" style="padding-left: 20px;">
                <input class="form-control me-sm-2" type="text" placeholder="Search.." name="search">
                <button class="btn btn-secondary my-2 my-sm-0" style="background-color:darkred;" type="submit">Search</button>
              </form>
              <div class="nav-item dropdown" >
                  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"style="background-color:darkred; height:47px;" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Browse Categories</button>
                  <div class="dropdown-content">
                    <a class="dropdown-item" href="/category/Romance"> Romance</a> 
                    <a  class="dropdown-item"  href="/category/Comedy"> Comedy</a> 
                    <a class="dropdown-item" href="/category/Biography"> Biography</a> 
                    <a class="dropdown-item" href="/category/Sport"> Sport</a> 
                    <a class="dropdown-item" href="/category/Drama"> Drama </a> 
                    <a class="dropdown-item" href="/category/Sci-Fi"> Sci-Fi </a> 
                    <a class="dropdown-item" href="/category/Western"> Western</a>
                    <a class="dropdown-item" href="/category/War"> War</a> 
                    <a class="dropdown-item" href="/category/Adventure"> Adventure</a> 
                    <a class="dropdown-item" href="/category/Horror"> Horror </a> 
                    <a class="dropdown-item" href="/category/Fantasy"> Fantasy </a> 
                    <a class="dropdown-item" href="/category/Mystery"> Mystery</a>
                    <a class="dropdown-item" href="/category/Crime"> Crime</a> 
                    <a class="dropdown-item" href="/category/Family"> Family</a> 
                    <a class="dropdown-item" href="/category/History"> History </a> 
                  </div>
              </div>

              </div>
            </div>
          </div>
        </nav>
      </header>

    
      <section id="container-fluid" style="margin-left: 12%;
  max-width: 80%;">
    
        @yield('content')
      </section>
    </main>
    
  </body>
</html>
