<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Rules\WordCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str as IlluminateStr;
use Illuminate\Foundation\Auth\Access\Authorizable;


class PostController extends Controller
{
    public function createPostPage(){

        return view('newPost');

    }


    public function createPost(Request $request, Post $post)
    {
        // Correcting the validation rules
        $fields = $request->validate([
            'subject' => ['required', 'min:5', 'max:200'],
               'content' => ['required', new WordCount(5, 1000)],
            'image'   => ['image',
                'mimes:jpeg,png,jpg,gif',
                'max:10000',
                'dimensions:min_width=50,max_width=5000']
        ]);
    
        // Correcting the strip_tags function usage
        $fields['subject'] = strip_tags($fields['subject']);
        $fields['content'] = strip_tags($fields['content']);
        $fields['user_id'] = auth()->id();
    
        // Creating the new post
        $post = Post::create($fields);
    
        // Handle the file upload if the file exists
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $customName = auth()->user()->id . '-' . IlluminateStr::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/post_avatars', $customName);
            $post->image = $customName;
            $post->save();
        }
    
        // Redirecting to the newly created post or a confirmation view
        return redirect("/post/". $post->id);
    }
    public function postPage(Post $post , User $user){
        return view("post_page",['post'=>$post], ["user"=> $user]);
    }

    public function editPostPage(Post $post){
        return view("editpost",['post'=> $post]);
    }

    public function editPost(Post $post, Request $request)
    {
        // Validate the request fields
        $fields = $request->validate([
            'subject' => ['required', 'min:5', 'max:200'],
            'content' => ['required', new WordCount(5, 1000)],
            'image'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10000', 'dimensions:min_width=50,max_width=5000']
        ]);
    
        // Update the post with validated fields
        $post->update([
            'subject' => strip_tags($fields['subject']),
            'content' => strip_tags($fields['content']),
        ]);
    
        // Handle the file upload if the file exists
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $customName = auth()->user()->id . '-' . IlluminateStr::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/post_avatars', $customName);
            $post->image = $customName;
            $post->save();
        }
    
        return redirect("/post/" . $post->id);
    }


        public function confirmDeletePage(Post $post){
           return view("post_delete",['post'=> $post]);
        }
    public function confirmDelete(Post $post){
        $post->delete();
        return redirect('/')->with("success", "Post Deleted");
    }

    public function authorPage(User $user){
        $posts = Post::where('user_id',$user->id)->orderByDesc("created_at")->paginate(2);
        return view("author",["posts" => $posts,"numOfPosts" => count($posts), 'user' => $user]);
        
    }

    public function like(Post $post){
        // Like::create(['user_id' =>auth()->user()->id, 'post_id'=>$post->id])
        if($post->is_liked_by_user()){
            $post->likes()->where('user_id', auth()->user()->id)->delete();
            return response()->json(['liked' => false]);
        }
        $post->likes()->create(['user_id' => auth()->user()->id]);
        return response()->json(['liked' => true]); 
    }

   
        // public function show($id)
        // {
        //     $post = Post::with('likedUsers')->findOrFail($id);
        //     return view('posts.show', compact('post'));
        // }

}
