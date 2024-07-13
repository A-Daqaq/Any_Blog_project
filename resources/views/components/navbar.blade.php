<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">ِAny Blog</a>
      </div>
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="/about">About</a>
          </li>
           <li>
            <a href = "/"> Home</a>
           </li>
            @auth 
            <li><a href = "/logout"> Logout</a> </li>
            <li><a href = "/saved-posts"> Saved Posts</a> </li>
            <li> <a href="/create-post">Create Post</a></li>
            <li><a href="{{ route('author', ['user' => auth()->id()]) }}">Profile</a></li>
            @else

          <li>
            <a href="login">Login</a>
          </li>
          <li>
            <a href="sign-up">Sign up</a>
          </li>
          @endauth
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>