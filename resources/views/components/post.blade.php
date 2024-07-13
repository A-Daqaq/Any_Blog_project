<div class="card mb-4">
  <div class="card-body">
    <div class="media">
      <img class="mr-3 rounded-circle" src="/storage/Post_avatars/{{ $image ?? 'defaultPost.png' }}" width="750" height="417" alt="User Avatar" style="margin-bottom: 10px">
      <div class="media-body">
        <h2 class="post-title">
          <a href="/post/{{$id}}">{{$subject}}</a>
        </h2>
        @if($author != "-1")
          <a href="/author/{{$authorid}}" class="lead">
            by {{$author}}
          </a>
        @endif
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{$datePosted}}</p>
        <p>{{$content}}</p>
        <div class="d-flex">
          <a class="btn btn-primary mr-2" href="/post/{{$id}}" id="readMoreBtn{{$id}}">Review</a>
          <button class="btn btn-outline-secondary" onclick="readLater({{$id}})" read-later-btn="{{$id}}">
            {{in_array($id, session('read_later',[])) ? 'Saved' : 'Read Later'}}
          </button>
        </div>
      </div>
    </div>
    <hr>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('[id^="readMoreBtn"]').forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        const postId = this.href.split('/').pop();
        window.location.href = `/post/${postId}`;
      });
    });
  });
  </script>