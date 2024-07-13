<x-layout>

  @if(session()->has("success"))
    <!-- Success Message Handling -->
  @endif

 <!-- Page Content -->
 <div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-12">

      @foreach($posts as $post)
   
      <x-post
          subject="{{ $post->subject }}"
          id="{{ $post->id }}"
          author="{{ $post->user->name }}"
          content="{{ $post->content }}"
          datePosted="{{ $post->created_at->format('Y-m-d H:i:s') }}"
          authorid="{{ $post->user->id }}"
          image="{{ $post->image ?? 'defaultPost.png' }}"
      />

      @endforeach
      
      <!-- Laravel Pagination Links -->
      <div class="d-flex justify-content-center">
          {!! $posts->links('pagination::bootstrap-4') !!}
      </div>

    </div>

  </div>
  <!-- /.row -->

</div>

</x-layout>
