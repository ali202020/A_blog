@extends('layouts.manage')

@section('content')

  <div class="flex-container">
    {{-- *******  Start of Flash Message  ********--}}
    @if (session('status'))
        <article class="message is-success flash-message">
          <div class="message-header msg-content is-success">
            {{ session('status') }}
          </div>
        </article>
    @endif
    {{-- *******  End of Flash Message  ********--}}


    {{-- ************************************ --}}
    {{-- ***** Start of Index Page Header ****--}}
    {{-- *************************************--}}
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">This is Show page</h1>
      </div>
      <div class="column">
        <a href="{{route('posts.create')}}" class="button is-primary is-rounded is-outlined is-pulled-right">Create New Post<i class="fa fa-user"></i></a>
      </div>
      <hr class="m-t-0">
    </div>
    {{-- ************************************ --}}
    {{-- *******  Start of Post Card  ********--}}
    {{-- *************************************--}}
    <div class="card">
      <div class="card-content">
        <p class="title">
          {{$post->title}}
        </p>
        <p class="subtitle">
          BY : {{$post->user->name}}&nbsp;&nbsp;&nbsp;
          Published at : {{$post->published_at}}
        </p>
        <hr>
        {{-- <div class="card-content"> --}}
        <p class="content">
          {!! $post->content !!}
        </p>
        {{-- </div> --}}
      </div>
      <footer class="card-footer">
        <a href="{{route('posts.edit',['slug'=>$post->slug])}}" class="button is-info card-footer-item ">Edit&nbsp;<i class="fa fa-edit"></i></a>
        <form action="{{route('posts.destroy',['slug'=>$post->slug])}}" method="POST" role="form" class="card-footer-item" style="padding:0px;">
          {{ csrf_field() }}
          {{ method_field('DELETE')}}
          <button type="submit" class="button is-danger card-footer-item" style="padding:0px;border:0px">Delete&nbsp;<i class="fa fa-trash"></i></button>
        </form>
      </footer>
    </div>
  </div>

@endsection
