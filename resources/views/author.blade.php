<x-layout>
    <div class="container mt-5">

        <div class="row mb-4 justify-content-center">
            <!-- Page Title -->
            <div class="col-md-12 text-center">
                <div class="header d-flex align-items-center justify-content-center">
                    <a href="{{$posts[0]->user->id}}">
                        <img class="avatar" src="/storage/avatars/{{$user->avatar}}" width='100px' height="100px" alt="">
                    </a>
                    <div class="ml-3">
                        <h2 class="mb-0"> {{$posts[0]->user->name}} ({{$numOfPosts}} {{ Str::plural('Post', $numOfPosts) }})</h2>
                        @can('update', $user)
                            <a href='/change-avatar/{{$user->id}}' class="btn btn-primary mt-2">Change Avatar</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
                @foreach($posts as $post)
                    <x-post
                        subject="{{ $post->subject }}"
                        id="{{ $post->id }}"
                        author="-1"
                        content="{{ $post->content }}"
                        datePosted="{{ $post->created_at->format('Y-m-d H:i:s') }}"
                        authorid="{{ $post->user->id }}"
                        image="{{ $post->image ?? 'defaultPost.png' }}"
                    />
                @endforeach

                <!-- Pager -->
                <div class="d-flex justify-content-center">
                    {!! $posts->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>

    <style>
        .header {
            margin-bottom: 20px;
        }
        .avatar {
            border-radius: 50%;
        }
        .pagination .page-link {
            color: #007bff;
        }
        .pagination .page-link:hover {
            color: #0056b3;
        }
    </style>
</x-layout>
