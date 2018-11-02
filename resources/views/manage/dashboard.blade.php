@extends('layouts.app')
@section('content')
  <div class="container">
    {{-- *******  Start of Flash Message  ********--}}
    {{-- @if (session('status'))
        <article class="message is-success flash-message">
          <div class="message-header msg-content is-success">
            {{ session('status') }}
          </div>
        </article>
    @endif --}}
    {{-- *******  End of Flash Message  ********--}}


    {{-- The second Nav bar --}}


    {{-- ************************************ --}}
    {{-- *******  Start of Post tile  ********--}}
    {{-- *************************************--}}
    <div class="tile is-ancestor post-tile m-t-5">
      @foreach ($posts as $post)
        <div class="tile is-parent is-10 is-vertical">
          <div class="tile is-child box">
            <p class="title">{{$post->title}}</p>
            <p class="subtitle">
              BY : {{$post->user->name}}&nbsp;&nbsp;&nbsp;
              Published at : {{$post->published_at}}
            </p>
            {{-- Start Of Post Content --}}
            <div class="content">
              {{$post->excerpt}} <span>....<a href="{{route('posts.show',['slug'=> $post->slug])}}">Readmore</a></span>
            </div>
          </div>
        </div>
      @endforeach

      {{-- ************************************--}}
      {{-- ***  Start Of Create Post Widget ***--}}
      {{-- *********************************** --}}
      <div class="tile is-parent is-2">
        <div class="tile is-child box">
          @if (Auth::check())
            <a href="{{route('posts.create')}}" class="button is-primary">Create New Post</a>
          @else
            <a class="button is-primary" title="Please Login To Create A Post" disabled>Create New Post</a>
          @endif
        </div>
      </div>
      {{-- ***  End Of Create Post Widget ***--}}
    </div>
  </div>

@endsection
