@extends('app')
@section('title')
{{ $title }}
@endsection

@section('content')
@if (!$posts->count() )
There is no post till now. Login and write a new post!
@else
<div>
  @foreach ( $posts as $post )
  <div class="list-group">
    <div class="list-group-item">
      <h3>
        <a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
      </h3>
      <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By {{ $post->author->name }}</p>
      <a href="{{ url('/'.$post->slug) }}"><h5>{{ count($post->comments) }} comments</h5></a>
    </div>
    <div class="list-group-item">
      <article>
        {!! str_limit($post->body, $limit=500, $end='... <a href='.url("/".$post->slug).'>Read More</a>') !!}
      </article>
    </div>
  </div>
  @endforeach
  {!! $posts->render() !!}
</div>
@endif
@endsection
