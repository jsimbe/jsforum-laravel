@extends('app')
@section('title')
Edit Post
@endsection
@section('content')
<form action="{{ url('/update') }}" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <input type="hidden" name="post_id" value="{{ $post->id }}" />
  <div class="form-group">
    <input type="text" name="title" value="@if(!old('title')){{$post->title}}@endif{{old('title')}}" class="form-control" placeholder="Enter title here"/>
  </div>
  <div class="form-group">
    <textarea name="body" class="form-control" rows="8" cols="40">@if(!old('body')){!!$post->body!!}@endif{!!old('body')!!}</textarea>
  </div>
  @if($post->active == '1')
  <input type="submit" name="publish" class="btn btn-success" value="Update" />
  @else
  <input type="submit" name="publish" class="btn btn-success" value="Publish" />
  @endif
</form>
@endsection
