<x-layout>

    <div class="container">

        <div class="row">
  
          <div class="col-lg-2"></div>
  
          <!-- Login content  -->
          <div class="col-lg-8 login">
  
            <!-- Title -->
            <h1>Login</h1>
  
            <!-- Login form -->
            <form action="/login" method="post" class="login-form">
              <div class="form-group">
                <label for="username">Username</label>
                @csrf
                <input type="text" id="username" name="name" class="form-control" value = "{{old('username')}}">
                @error('name')
                    
                <div class= "alert alert-danger">
                  <strong> error!</strong> {{$message}}
            
                @enderror
              </div>
  
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" >
                @error('password')
                    
                <div class= "alert alert-danger">
                  <strong> error!</strong> {{$message}}
            
                @enderror
              </div>
  
              <button type="submit" class="btn btn-primary">Log in</button>
              <p>Don't have an account? <a href="/sign-up">Sign Up Now</a></p>
            </form>
            <!-- /form -->
          </div>
  
          <div class="col-lg-2"></div>
  
        </div>
        <!-- /.row -->
  
      </div>
      <!-- /.container -->
  
</x-layout>