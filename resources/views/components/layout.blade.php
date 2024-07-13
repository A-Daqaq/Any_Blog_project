<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="">

  <title>Home - YouBee Blog Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="{{ asset('css/simple-blog-template.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>

    .SearchBar{
      display: flex;
      flex-direction: row;
      justify-content: center;

    }
    .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
    </style>

    </style>

</head>

<body>



  <x-navbar/>
  <div class="SearchBar">
  <form action ='/search' method="post" class="form-inline my-2 my-lg-0">
    @csrf
   
  <input type="search" name = "query" placleholder="search"  class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
  </form>
</div>
<br>

    {{$slot}}


  <x-footer>
  
  </x-footer>

  <!-- jQuery -->
  <script src="{{ asset('js/jquery.js') }}"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>

  <script>

function readLater(postId) {
  let btn = document.querySelector('[read-later-btn="' + postId + '"]');
  let options = {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'x-CSRF-TOKEN': '{{csrf_token()}}'
    },
    body: JSON.stringify({ id: postId }) // Fixed typo: changed JSON.Stringify to JSON.stringify
  };
  fetch('/read-later', options)
    .then(response => response.json())
    .then(data => {
      if (data.status === 'removed') { // Changed '==' to '===' for strict equality
        btn.innerHTML = 'Read Later';
      } else if (data.status === 'added') { // Changed '==' to '===' for strict equality
        btn.innerHTML = "Saved";
      }
    })
    .catch(error => console.error("Error:", error)); // Fixed error logging syntax
}

  </script>
    
    

</body>

</html>
