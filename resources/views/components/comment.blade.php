
@if($reply == 0)
<div class="media">
@else
    <div class="media" style="margin-left:20px">
@endif
    <a class="pull-left" href="#">
      @if (!empty($avatar))
      <img class="media-object" src="/storage/avatars/{{$avatar}}" width='64px' height="64px" alt="User Avatar">
  @else
      <img class="media-object" src="/storage/avatars/default.png" width='64px' height="64px" alt="Default Avatar">
  @endif
    </a>
    <div class="media-body">
      <h4 class="media-heading">{{$name}}
        <small>{{$datePosted}}</small>
      </h4>
     {{$content}}
    </div>
  </div>