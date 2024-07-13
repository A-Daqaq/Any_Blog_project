<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Comment extends Component
{
    /**
     * Create a new component instance.
     */

     public $datePosted, $content, $name ,$reply;
    public function __construct($datePosted, $content, $name,$reply)
    {
        $this->datePosted = $datePosted;
        $this->name = $name;
        $this->content = $content;
        $this->reply = $reply;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comment');
    }
}
