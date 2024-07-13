<x-layout>



    <div class="container">

        <div class="row">
  
          <div class="col-lg-2"></div>
  
          <!-- Signup content  -->
          <div class="col-lg-8 signup">
  
            <!-- Title -->
            <h1>Sign up</h1>
  
            <!-- Login form -->
            <form action="/sign-up" method="POST" class="signup-form">

                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required value ="{{old('email')}}"> 
                    @error('email')
                    
                      <div class= "alert alert-danger">
                        <strong> error!</strong> {{$message}}
                  
                      @enderror
                  </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="name" class="form-control" required value ="{{old('name')}}">
                @error('name')
                    
                <div class= "alert alert-danger">
                  <strong> error!</strong> {{$message}}
            
                @enderror
              </div>
  
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required >
                @error('password')
                    
                <div class= "alert alert-danger">
                  <strong> error!</strong> {{$message}}
            
                @enderror
              </div>
  
              <div class="form-group">
                <label for="password">Password Confirmation</label>
                <input type="password" id="confirmation" name="password_confirmation" class="form-control" required>
                @error('password_confirmation')
                    
                <div class= "alert alert-danger">
                  <strong> error!</strong> {{$message}}
            
                @enderror
              </div>
  
             
              <button type="submit" class="btn btn-primary">Sign up</button>
            </form>
            <!-- /form -->
          </div>
  
          <div class="col-lg-2"></div>
  
        </div>
        <!-- /.row -->
  
      </div>
      <!-- /.container -->
  
</x-layout>