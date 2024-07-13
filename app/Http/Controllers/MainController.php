<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Dotenv\Util\Str as DotenvStr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str as IlluminateStr;



class MainController extends Controller
{
    public function homePage(){
        $posts = Post::paginate(2);
        return view ('home',['posts' => $posts]);
    }


    public function aboutPage(){
        return view('about');
    }

    public function searchPage(Request $request){
        $fields = $request->validate([
            'query' => "required|min:1|max:255"
        ]);
        $posts = Post::search($fields['query'])->paginate(2);
        return view ('home',['posts' => $posts]);
    }
    public function readLater(Request $request){
        $fields = $request->validate([
            'id'=>['required','int']
        ]);
        $postId = $fields['id'];
        $readLater = session('read_later',[]);
        if(in_array($postId, $readLater)){
            $readLater = array_diff($readLater,[$postId]);
            session(['read_later' => $readLater]);
            return response()->json(['status' => 'removed']);
        } else{
            $readLater[] = $postId;
            session(['read_later' => $readLater]);
            return response()->json(['status' => 'added']);
        }
        
    }

    public function savedPostPage(){
        $savedPostsIds = session('read_later',[]);
        $posts = Post::whereIn('id', $savedPostsIds)->paginate(3);
        return view('home',['posts' => $posts]);
    }

    public function changeAvatarPage(User $user){
        return view('change-avatar');
    }

    public function changeAvatar(User $user, Request $request)
    {
        $fields = $request->validate([
            'avatar' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                'dimensions:min_width=50,max_width=1500'
            ]
        ]);

        $file = $request->file('avatar');

        $customName = auth()->user()->id . '-' . IlluminateStr::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/avatars', $customName);

        $user->avatar = $customName;
        $user->save();

        return redirect('/author/' . auth()->user()->id);
    }

}
