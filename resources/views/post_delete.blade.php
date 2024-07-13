<x-layout>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8  main">
          <div class="card border-danger">
            <div class="card-header bg-danger text-white">
              <h1 class="text-center">Confirm Delete !!</h1>
            </div>
            <div class="card-body">
              <p class="lead text-center">Are you sure you want to delete the post titled "<strong>{{ $post->subject }}</strong>"?</p>
              <div class="buttons">
                <form action="/post/delete/{{ $post->id }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-lg mx-2">Delete</button>
                </form>
                <a href="/post/{{ $post->id }}" class="btn btn-info btn-lg mx-2">Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-layout>
  
  <style>
    .container {
      margin-top: 50px;
      display: flex;
      justify-content: center;
      align-items: center;


    }
  
    .card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
  
    .card-header {
      background-color: #dc3545;
      color: white;
    }
  
    .btn-lg {
      padding: 10px 20px;
      font-size: 18px;
    }
  
    .mx-2 {
      margin-left: 0.5rem !important;
      margin-right: 0.5rem !important;
    }
    .buttons{
        display: flex;
        justify-content: center;
    }
    .main{
        align-self: center;

    }
  </style>
  