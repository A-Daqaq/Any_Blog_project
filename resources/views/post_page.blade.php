<x-layout>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <!-- Blog Post Content Column -->
      <div class="col-lg-12">
        <!-- Blog Post -->

        <!-- Title -->
        <h1 class="post-title">{{$post->subject}}</h1>
        <br>
        
        <!-- Post Image -->
        @if ($post->image)
          <img src="/storage/post_avatars/{{$post->image}}" class="img-fluid" alt="Post Image" width="750" height="417" style="margin-bottom: 10px">
        @endif
        <br>
        <!-- Author -->
        <a href="/author/{{$post->user->id}}" class="lead" style="margin-bottom:20px">
          by {{$post->user->name}}
        </a>

        @can('update', $post)
          <br><br>
          <a class="btn btn-warning" href="/post/edit/{{$post->id}}">Edit</a>
        @endcan

        @can('delete', $post)
          <a class="btn btn-danger" href="/post/delete/{{$post->id}}">Delete</a>
        @endcan

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->format('F d, Y \a\t h:i A')}}</p>

        <hr>

        <!-- Post Content -->
        <p>{{$post->content}}</p>

        <hr>
        @auth
        <button class="btn btn-default" id="likeBTN" style="background-color: transparent; border: none;">
          <i class="fa {{$post->is_liked_by_user() ? 'fa-regular fa-heart' : 'fa- fa-heart'}}" aria-hidden="true" style="font-size: 24px; color: {{$post->is_liked_by_user() ? 'red' : 'black'}};"></i>
        </button>
        @endauth
        <!-- Liked By -->
        <div id="liked-by">
          <strong>Liked by:</strong>
          @if($post->likedUsers->isNotEmpty())
            @foreach($post->likedUsers as $user)
              <span>{{ $user->name }}</span>@if(!$loop->last), @endif
            @endforeach
          @else
            <span>No likes yet</span>
          @endif
        </div>

        <br>

        <!-- Blog Comments -->

        <!-- Comments Form -->
        @auth
        <div class="well">
          <h4>Leave a Comment:</h4>
          <form action="/post/comment/{{$post->id}}" method="POST" role="form">
            @csrf
            <div class="form-group">
              <textarea class="form-control" rows="3" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        @endauth

        <hr>

        <!-- Posted Comments -->
        @foreach($post->comments->where('parent_id', null) as $comment)
          <div class="media">
            <a class="pull-left" href="#">
              @if (!empty($comment->user->avatar))
                <img class="media-object" src="/storage/avatars/{{$comment->user->avatar}}" width='64px' height="64px" alt="">
            @else
            <img class="media-object" src="/storage/avatars/defualt.png" width='64px' height="64px" alt="">
            @endif
            </a>
            <div class="media-body">
              <h5 class="media-heading">{{$comment->user->name}}
                <small>{{$comment->created_at->format('Y-m-d H:i:s')}}</small>
              </h5>
              <p>{{$comment->content}}</p>

              <!-- Reply Button -->
              @auth
              <button class="btn btn-link reply-btn" data-target="#reply-form-{{$comment->id}}">
                <i class="fa fa-reply"></i> Reply
              </button>

              <!-- Reply Form -->
              <div id="reply-form-{{$comment->id}}" class="reply-form" style="display: none; margin: 20px 0 20px 40px;">
                <div class="well">
                  <h5>Leave a reply:</h5>
                  <form action="/post/comment/{{$post->id}}" method="POST" role="form">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{$comment->id}}">
                    <div class="form-group">
                      <textarea class="form-control" rows="2" name="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-sm">Submit</button>
                  </form>
                </div>
              </div>
              @endauth

              <!-- Nested Replies -->
              @foreach($comment->replies as $reply)
                <div class="media" style="margin:20px 0 20px 40px;">
                  <a class="pull-left" href="#">
                    @if (!empty($reply->user->avatar))
                            <img class="media-object" src="/storage/avatars/{{$reply->user->avatar}}" width='64px' height="64px" alt="">
                        @else
                            <img class="media-object" src="/storage/avatars/default.png" width='64px' height="64px" alt="Default Avatar">
                        @endif
                  </a>
                  <div class="media-body">
                    <h5 class="media-heading">{{$reply->user->name}}
                      <small>{{$reply->created_at->format('Y-m-d H:i:s')}}</small>
                    </h5>
                    <p>{{$reply->content}}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->

  <!-- Include Font Awesome -->
 

  <!-- Include jQuery if not already included -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.reply-btn').on('click', function() {
        var target = $(this).data('target');
        $(target).toggle();
      });
    });

    document.addEventListener("DOMContentLoaded", function() {
      let btn = document.getElementById("likeBTN");
      btn.addEventListener("click", function() {
        let postId = {{$post->id}};
        let options = {
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          }
        }

        fetch('/post/like/' + postId, options)
          .then(response => response.json())
          .then((data) => {
            let icon = btn.querySelector('i');
            if (data.liked) {
              // icon.classList.remove('fa-regular');
              icon.classList.add('fa-solid');
              icon.style.color = 'red';
            } else {
              // icon.classList.remove('fa-solid');
              icon.classList.add('fa-regular');
              icon.style.color = 'black';
            }
          })
          .catch(error => console.error("Error: ", error));
      });
    });
  </script>
</x-layout>
