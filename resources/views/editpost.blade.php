<x-layout>
  
  <div class="container">

    <div class="row">

      <!-- Newpost content  -->
      <div class="col-lg-12 newpost">

        <!-- Title -->
        <h1>Edit Post</h1>

        <!-- Newpost form -->
        <form action="/post/edit/{{$post->id}}" method="post" class="newpost-form" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="form-control" value="{{ old('subject', $post->subject) }}">
            @error('subject')
            <div class="alert alert-danger">
              <strong>Error!</strong> {{$message}}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="5" id="content" name="content" class="form-control">{{ old('content', $post->content) }}</textarea>
            @error('content')
            <div class="alert alert-danger">
              <strong>Error!</strong> {{$message}}
            </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="avatar">Image</label>
            <input type="file" id="avatar" name="image" class="form-control-file">
            @error('image')
                <div class="alert alert-danger">
                    <strong>Error!</strong> {{ $message }}
                </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        <!-- /form -->
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

</x-layout>
