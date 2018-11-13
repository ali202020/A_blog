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
                          <small>Everyone can see</small>
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
                @foreach ($posts as $post)
                  <div class="tile is-customized-tile box">
                    {{-- Start of Post Title --}}
                    <div class="custom-title">
                      <p>{{$post->title}}</p>
                      &nbsp;
                      <span><small>By</small></span>
                      <a href=""><span><small>{{$post->user->name}}</small></span></a>
                      &nbsp;
                      <span><small>Published at</small></span>
                      <span><small>{{$post->published_at->toFormattedDateString()}}</small></span>
                    </div>
                    {{-- ---------------------- --}}


                    {{-- Start Of Post Content --}}
                    <div class="content">
                      {{$post->excerpt}} <span>....<a href="{{route('posts.show',['slug'=> $post->slug])}}">Readmore</a></span>
                    </div>
                    {{-- --------------------- --}}
                    <hr>

                    {{-- Start Of Post Box Features --}}
                    <div class="post-box-features">
                      <span>
                        <a href=""><small><i class="fa fa-comments"></i>&nbsp;{{$post->comments->count()}}&nbsp;Comments</small></a>
                      </span>
                      {{-- Share DropDown Component --}}
                      <share-dropdown></share-dropdown>
                    </div>
                    {{-- -------------------------- --}}
                  </div>

                @endforeach
          </div>
        </div>
        {{-- ***  End Of Create Posts Container ***--}}

        {{-- ***  Start Of Create Post Widget ***--}}
        <div class="column is-3 p-l-5">
          {{-- Create post Button --}}
          <div class="tile posts-container is-customized-tile post-widget-container box ">

            @if (Auth::check())
              <a href="{{route('posts.create')}}" class="button is-primary is-half">Create New Post</a>
            @else
              <a class="button is-primary is-half" title="Please Login To Create A Post" disabled>Create New Post</a>
            @endif
          </div>
          {{-- ***************** --}}

          {{-- Advertisements Section --}}
          <div class="tile box columns ad-widget">
            <div class="column is-12">
              <p class="ad-title">Advertisement</p>
              <hr>
              <figure class="image is-4by5">
                <img src="https://bulma.io/images/placeholders/256x256.png">
              </figure>
            </div>
          </div>
          {{-- ************************--}}

          {{-- Website Footer section --}}
          <div class="tile box columns is-multiline footer-widget">
            <div class="column is-6">
              <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Press</a></li>
              </ul>
            </div>

            <div class="column is-6">
              <ul>
                <li><a href="#">Advertise</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Help</a></li>
              </ul>
            </div>

            <div class="column is-12" style="text-align:center;">
              <ul>
                <li><span><a href="#">Content Policy</a></span> | <span><a href="#">Privacy Policy</a></span></li>
                <li><span><a href="#">User Agreement</a></span> | <span><a href="#">Mod Policy</a></span></li>
                <li><i class="fa fa-copyright fa-fw"></i> <span>2018 A_BLOG, Inc. All rights reserved</span></li>
              </ul>
            </div>
          </div>
          {{-- *********************** --}}


        </div>
      {{-- ***  End Of Create Post Widget ***--}}
      </div>
    </div>





{{-- Vue js Start scripts --}}

@section('scripts')
  <script>
    //****************************    Share drop-down component   **************************************//
    Vue.component('share-dropdown',{
      template:'<span v-on:click.prevent="active = !active">\
                  <a href=""><small><i class="fa fa-share"></i>&nbsp;Share</small></a>\
                  <div v-bind:class="{share_dropdown_hide:!active , share_dropdown:active}">\
                    <a href="#" v-on:click="popupFacebook">\
                      <small><i class="fa fa-facebook"></i>&nbsp; Share On Facebook</small>\
                    </a>\
                    <hr>\
                    <a href="#" v-on:click="popupTwitter">\
                      <small><i class="fa fa-twitter"></i>&nbsp; Share On Twitter</small>\
                    </a>\
                  </div>\
                </span>',
      data:function(){return{
        active:false,
      }},
      methods:{
        popupTwitter:function(){
          window.open('https://twitter.com/intent/tweet?text=post_title&url=#', '_blank', 'scrollbars=0, resizable=1, menubar=0, left=400, top=200, width=550, height=440, toolbar=0, status=0');
          return false;
        },
        popupFacebook:function(){
          window.open('https://www.facebook.com/sharer/sharer.php?u=#', '_blank', 'scrollbars=0, resizable=1, menubar=0, left=400, top=200, width=650, height=410, toolbar=0, status=0');
          return false;

        },
      },
    });
    //******************************************************************************************************//
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
