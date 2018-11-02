@extends('layouts.app')
@section('content')

    {{-- *******  Start of Flash Message  ********--}}
    {{-- @if (session('status'))
        <article class="message is-success flash-message">
          <div class="message-header msg-content is-success">
            {{ session('status') }}
          </div>
        </article>
    @endif --}}
    {{-- *******  End of Flash Message  ********--}}


    {{-- The Second Nav bar --}}
    <div class="container-flex secondary-nav">
      <div class="container">
        <template>
          <div class="tag sort-title">Sort</div>
          <b-dropdown v-model="isPublic">
              <div class="tag custom-dropdown-btn" type="button" slot="trigger">
                  <template v-if="isPublic">
                      <b-icon icon="trending-up"></b-icon>&nbsp;
                      <span>Trending & Popular</span>
                  </template>
                  <template v-else>
                      <b-icon icon="new-box"></b-icon>&nbsp;
                      <span>Latest</span>
                  </template>
                  <b-icon icon="menu-down"></b-icon>
              </div>

              <b-dropdown-item :value="true">
                  <div class="media">
                      <b-icon class="media-left" icon="trending-up"></b-icon>
                      <div class="media-content">
                          <h3>Trending & Popular</h3>
                          <small>Everyone can see</small>
                      </div>
                  </div>
              </b-dropdown-item>

              <b-dropdown-item :value="false">
                  <div class="media">
                      <b-icon class="media-left" icon="new-box"></b-icon>
                      <div class="media-content">
                          <h3>Latest</h3>
                          <small>Only friends can see</small>
                      </div>
                  </div>
              </b-dropdown-item>
          </b-dropdown>
      </template>
    </div>
  </div>
    {{-- *************************** --}}


    {{-- ************************************ --}}
    {{-- *******  Start of Post tile  ********--}}
    {{-- *************************************--}}
    <div class="container">
      <div class="columns">
        {{-- ***  Start Of Create Posts Container ***--}}
        <div class="column is-9 p-r-5">
          <div class="posts-container">
            {{-- <div class="tile is-ancestor post-tile m-t-5"> --}}
                @foreach ($posts as $post)
                {{-- <div class="tile is-parent is-8 is-vertical box"> --}}
                  <div class="tile is-customized-tile box">
                    <p class="title custom-title">{{$post->title}}</p>

                    <div class="tags has-addons">
                      <span class="tag is-dark">By</span>
                      <span class="tag is-primary">{{$post->user->name}}</span>
                    </div>
                    <div class="tags has-addons">
                      <span class="tag is-dark">Published at</span>
                      <span class="tag is-primary">{{$post->published_at}}</span>
                    </div>
                    {{-- Start Of Post Content --}}
                    <div class="content">
                      {{$post->excerpt}} <span>....<a href="{{route('posts.show',['slug'=> $post->slug])}}">Readmore</a></span>
                    </div>
                  </div>
                {{-- </div> --}}
                @endforeach
            {{-- </div> --}}
          </div>
        </div>
        {{-- ***  End Of Create Posts Container ***--}}

        {{-- ***  Start Of Create Post Widget ***--}}
        <div class="column is-3 p-l-5">
          <div class="tile posts-container is-customized-tile post-widget-container box ">

            @if (Auth::check())
              <a href="{{route('posts.create')}}" class="button is-primary is-half">Create New Post</a>
            @else
              <a class="button is-primary is-half" title="Please Login To Create A Post" disabled>Create New Post</a>
            @endif
          </div>
        </div>
      {{-- ***  End Of Create Post Widget ***--}}
      </div>
    </div>





{{-- Vue js Start scripts --}}

@section('scripts')
  <script>
    var app = new Vue({
      el:'#app',
      data:{
        isPublic:true,
      },
      methods:{
      },
    });
  </script>
@endsection
{{-- Vue js End scripts --}}

@endsection
