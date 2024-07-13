<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Post extends Component
{
    public $id;
    public $author;
    public $subject;
    public $content;
    public $datePosted;
    public $authorid;
    public $image;

    // public $authorid;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $author, $subject, $content, $datePosted,$authorid, $image)
    {
        $this->id = $id;
        $this->author = $author;
        $this->subject = $subject;
        $this->content = $content;
        $this->datePosted = $datePosted;
        $this->authorid = $authorid;
        $this->image = $image;
        

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post');
    }
}
