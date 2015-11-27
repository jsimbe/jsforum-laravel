@extends('app')
@section('title')
  @if($post)
  {{ $post->title }}
    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
    <button class="btn btn-default" style="float: right"><a href="{{ url('/edit/'.$post->slug) }}">Edit Post</a></button>
    @endif
  @else
  Page does not exist!
  @endif
@endsection

@section('content')
@if($post)
<div>
  {{ $post->body }}
</div>
<h2>Leave a comment</h2>
  @if(Auth::guest())
  <p>Login to comment</p>
  @else
  <div class="panel-body">
    <form action="/comment/add" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <input type="hidden" name="on_post" id="" value="{{ $post->id }}" />
      <input type="hidden" name="slug" id="" value="{{ $post->slug }}" />
      <div class="form-group">
        <textarea name="body" id="" rows="3" cols="20" placeholder="Enter your comment here" class="form-control"></textarea>
      </div>
      <input type="submit" name="post_comment" id="" value="Post Comment" class="btn btn-primary" />
    </form>
  </div>
  @endif
  @if($comments)
  <ul style="list-style: none; padding: 0;">
    @foreach($comments as $comment)
    <li class="panel-body">
      <div class="list-group">
        <div class="list-group-item">
          <h3>{{$comment->author->name}}</h3>
        </div>
        <div class="list-group-item">
          <p>{{ $comment->body }}</p>
        </div>
      </div>
    </li>
    @endforeach
  </ul>
  @endif
@endif
@endsection
