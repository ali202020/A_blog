@extends('layouts.app')
@section('content')
  <div class="container m-t-15">
    {{-- *******  Start of Flash Message  ********--}}
    @if (session('status'))
        <article class="message is-success flash-message">
          <div class="message-header msg-content is-success">
            {{ session('status') }}
          </div>
        </article>
    @endif
    {{-- *******  End of Flash Message  ********--}}



    <div class="columns m-t-5">
      {{-- ************************************ --}}
      {{-- *******  Start of Post tile  ********--}}
      {{-- *************************************--}}

      <div class="column is-9">
        <div class="posts-container">
          <div class="tile is-customized-tile box">
            {{-- ******************************************************* --}}
            {{-- ******************************************************* --}}
            {{-- User Info TO be Added Here Or At the Bottom of the page --}}
            {{-- ******************************************************* --}}
            {{-- ******************************************************* --}}
            <p class="title">{{$post->title}}</p>
            <p class="subtitle about-post-info">
              By : <a href="#">{{$post->user->name}}</a>&nbsp;&nbsp;
              Published At : {{$post->published_at->toFormattedDateString()}}
            </p>
            {{-- Start Of Post Content --}}
            @if ($post->media != null)
              @if (strpos($post->media,'mp4') != false)
                <video src="/storage/media/{{$post->media}}"></video>
              @else
                <div class="is-centered">
                  <img src="/storage/media/{{$post->media}}" alt="">
                </div>
              @endif
            @else
              <p>
                {!! $post->content !!}
              </p>
            @endif

            {{-- End Of Post Content --}}

            {{-- Only authenticated user who is the owner of the post is the only one who can edit it --}}
            <br>
            @if (Auth::check() && Auth::user()->id == $post->user->id)
              <small>
                <a href="{{route('posts.edit',['slug'=>$post->slug])}}" class="edit-link">
                  <i class="fa fa-edit"></i>&nbsp;Edit Post
                </a>
                &nbsp;.&nbsp;
                {{-- Start Of Delete Form --}}
                {{-- <button type="submit" class="button is-danger is-rounded">Delete&nbsp;<i class="fa fa-trash"></i></button> --}}
                <a class="delete-link" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                  <i class="fa fa-trash"></i>&nbsp;Delete Post
                </a>
                <form id="delete-form" action="{{route('posts.destroy',['slug'=>$post->slug])}}" method="POST" role="form" class="card-footer-item" style="display: none;">
                  {{ csrf_field() }}
                  {{ method_field('DELETE')}}
                </form>
                {{-- End Of Delete Form --}}
              </small>
            @endif
            {{-- ****************************************** --}}
            {{-- ********  Start Of Comments Section  ******--}}
            {{-- ****************************************** --}}
            <hr>
            <p class="subtitle">Comments : </p>

            <article class="media" v-for="comment in comments">
              <figure class="media-left">
                <p class="image is-64x64">
                  <img src="https://bulma.io/images/placeholders/128x128.png">
                </p>
              </figure>
              <div class="media-content">
                <div class="content">
                  <p>
                    <strong>@{{comment.user.name}}</strong>
                    <br>
                    @{{comment.body}}
                    <br>
                    <small><a>Like</a> · <a>Reply</a> · @{{comment.created_at}}</small>
                  </p>
                </div>
              </div>
            </article>

            {{-- Only Registered Users Who can leave A Comment --}}
            @if (Auth::check())
              <article class="media">
                <figure class="media-left">
                  <p class="image is-64x64">
                    <img src="https://bulma.io/images/placeholders/128x128.png">
                  </p>
                </figure>
                <div class="media-content">
                  <div class="field">
                    <p class="control">
                      <textarea class="textarea" placeholder="Add a comment..." v-model="comment_body"></textarea>
                    </p>
                  </div>
                  <div class="field">
                    <p class="control">
                      <button class="button is-primary" @click="saveComment">Post comment</button>
                    </p>
                  </div>
                </div>
              </article>
            @else
              <article class="media">

                <div class="media-content">
                  <div class="field">
                    <p class="control">
                      To Leave A Comment You Must Be Logged In
                      <a href="{{route('login')}}">Login</a>

                      Or , Join Us Now If You Are Not Already A Member
                      <a href="{{route('register')}}">Sign Up</a>

                    </p>
                  </div>
                </div>
              </article>
            @endif
          {{-- ********  End Of Comments Section  ******--}}
          </div>
        </div>
      </div>
      {{-- *******  End of Post tile  ********--}}

      {{-- *********************************** --}}
      {{-- ***  Start Of Create Post Widget ***--}}
      {{-- *********************************** --}}
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

@endsection


{{-- Start Of Script Section --}}
@section('scripts')
  <script>

  const app = new Vue({
    el:'#app',
    data:{
      comment_body:'',
      comments:{},
      user:{!! Auth::check()? Auth::user()->toJson() : 'null' !!}

    },
    mounted:function(){
      this.getComments();
      this.eventListener();
    },
    methods:{
      getComments:function(){
        var gets =this;
        axios.get('/api/posts/'+{{$post->id}}+'/comments')
             .then((response)=>{
               gets.comments = response.data;
             })
             .catch(function(error){
               console.log(error.response.status);
             });

      },
      saveComment:function(){
        var instance = this;
        axios.post('/api/posts/'+{{$post->id}}+'/comment',{
              body:instance.comment_body,
              api_token:this.user.api_token
             })
             .then((response)=>{
               //console.log(response.data);
               instance.comments.unshift(response.data);
               instance.comment_body = '';
             })
             .catch(function(error){
               console.log(error);
               console.log(error.response.status);
             });
      },
      eventListener:function(){
        Echo.channel('post.'+{{$post->id}})
            .listen('NewComment',(comment)=>{
              this.comments.unshift(comment);
            });
      },

    },
  });




  </script>
@endsection
{{-- ************************ --}}
