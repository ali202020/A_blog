@extends('layouts.app')
@section('content')
  <div class="flex-container">
    {{-- *******  Start of Flash Message  ********--}}
    @if (session('status'))
        <article class="message is-danger flash-message">
          <div class="message-header msg-content is-danger">
            {{ session('status') }}
          </div>
        </article>
    @endif
    {{-- *******  End of Flash Message  ********--}}
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">Create New Post</h1>
      </div>
    </div>
    {{-- ************************************ --}}
    {{-- *******  Start of Post Form  ********--}}
    {{-- *************************************--}}
    <div class="columns">
      <div class="column is-three-quarters">
        <form action="{{route('posts.store')}}" method="POST" role="form" enctype="multipart/form-data">
          {{ csrf_field() }}

          {{-- *******  Start of Post slug  ********--}}
          <div class="field">
            <label class="label">Slug</label>
            <div class="control">
              <input class="input" type="text" name="slug" placeholder="ex:www.blog.com/this-is-mypost-url" size="is-small" v-model="title">
            </div>
            <p class="help is-success">enter the url that will the post</p>
            <p>
              <slug-widget url="{{url('/')}}" subdirectory="blog" :title="title" @pass-slug-to-parent = "parentSlug"></slug-widget>
            </p>
          </div>

         {{-- *******  End of Post slug  ********--}}


         {{--**********   Start Of Tilte   *******--}}
         <div class="field">
           <label for="content" class="label">Post title : </label>
           <div class="control">
             <input class="input" type="text" name="title" placeholder="Post Title">
           </div>
         </div>
         {{--*********    End Of Title  **********--}}

         {{-- *******  Start of Categories  ********--}}
         <div class="field">
          <label class="label">Category :</label>
          <div class="control">
            <div class="select is-primary">
              {{-- Future work: here will be added an input for the user to enter the category --}}
              <select name="category">
                <option value="Others" selected>Others</option>
                <option value="Social">Social</option>
                <option value="Medical">Medical</option>
                <option value="Engineering">Engineering</option>
                <option value="Automotives">Automotives</option>
                <option value="Mechanics">Mechanics</option>
                <option value="Mathematical">Mathematical</option>
              </select>
            </div>
          </div>
        </div>
        {{-- *******  End of Categories  ********--}}

        {{-- ---------------------------------------------- --}}
        {{-- -------     Start Of Post Toggle Tab --------- --}}
        {{-- ---------------------------------------------- --}}
        <div class="tabs is-toggle is-fullwidth">
          <ul>
            <li v-bind:class="{'is-active':textPost}" @click="showTextPost">
              <a>
                <span class="icon is-small"><i class="fa fa-book" aria-hidden="true"></i></span>
                <span>Post</span>
              </a>
            </li>
            <li v-bind:class="{'is-active':imgvidPost}" @click="showImgVidPost">
              <a>
                <span class="icon is-small"><i class="fa fa-image" aria-hidden="true"></i></span>
                <span>Images & Videos</span>
              </a>
            </li>
          </ul>
        </div>
        {{-- ---------------------------------------------- --}}



        {{-- ----------------------------------------- --}}
        {{-- -------     Start Of Text Post  --------- --}}
        {{-- ----------------------------------------- --}}
         <div class="field" v-show="textPost">
           <label for="content" class="label">Brief : </label>
           <div class="control">
             <textarea class="textarea" type="textarea" name="excerpt" placeholder="Write Your Brief Here that Will Appear For Others In The Home Page......" rows="2"></textarea>
           </div>
         </div>

         <div class="field" v-show="textPost">
           <label for="content" class="label">Post : </label>
           <div class="control">
             <textarea class="textarea textarea_content" type="textarea" name="content" placeholder="Write Your Post Here......" rows="10"></textarea>
           </div>
         </div>
         {{-- ----------------------------------------- --}}

         {{-- --------------------------------------------- --}}
         {{-- -------     Start Of Image/Video Post   ----- --}}
         {{-- --------------------------------------------- --}}
         <div class="field" v-show="imgvidPost">
          <div class="file is-centered is-boxed is-success has-name">
            <label class="file-label">
              <input class="file-input" type="file" name="media" ref="fileSpecs" v-on:input="getFileName">
              <span class="file-cta">
                <span class="file-icon">
                  <i class="fa fa-upload"></i>
                </span>
                <span class="file-label">
                  Upload Your File…
                </span>
              </span>
              <span class="file-name">
                @{{fileName}} &nbsp;&nbsp;
                @{{fileSize}}
              </span>
            </label>
          </div>
        </div>
         {{-- -------------------------------------------- --}}

          {{-- ------------------------------------------------------------ --}}
          {{-- -------     Start Of Url Post (Upcomming Feature) ---------- --}}
          {{-- ------------------------------------------------------------ --}}
           {{-- <div class="field">
             <label for="content" class="label">Brief : </label>
             <div class="control">
               <textarea class="textarea" type="textarea" name="excerpt" placeholder="Write Your Brief Here......" rows="2"></textarea>
             </div>
           </div>

           <div class="field">
             <label for="content" class="label">Post : </label>
             <div class="control">
               <textarea class="textarea textarea_content" type="textarea" name="content" placeholder="Write Your Post Here......" rows="10"></textarea>
             </div>
           </div> --}}
           {{-- ----------------------------------------------------------- --}}
          <button type="submit" class="button is-primary is-rounded is-fullwidth">Save Post</button>
        </form>
        {{-- Start of test inputs  --}}
        {{-- <div class="button" @click="showTextPost">show text</div>
        <div class="button" @click="showImgVidPost">show imgvid</div>
        <br>
        <div type="text" style="background-color:grey;" v-show="textPost">text</div>
        <br>
        <div type="text" style="background-color:grey;" v-show="imgvidPost">img/vid</div> --}}
        {{-- End of test inputs --}}
      </div>
      {{-- *******  End of Post Form  ********--}}





    <div class="column is-one-quarter">
      <div class="card card-widget">
        <div class="card-content">

          <div class="writer-widget-area">
            <img src="https://placehold.it/50x50" alt="photo">
            <div class="writer-info">
              <p> <strong>By: Ali</strong> <br> {Ali ahmed}</p>
            </div>

          </div>
          <div class="post-status-widget-area">
            <b-icon
                pack="fa"
                icon="file-text"
                size="is-medium" class="draft-icon">
            </b-icon>
            <div class="post-status">
              <p> <strong>Draft Updated :</strong> <br> a few minutes ago (saved)</p>
            </div>

          </div>
          <div class="btns-widget-area">
            <button class="button is-info is-small">Save Draft</button>
            <button class="button is-primary is-small">Publish Now</button>
          </div>

        </div>
      </div>
    </div>
   </div>
  </div>
@endsection

@section('scripts')
  <script>
    const app = new Vue({
      el:'#app',
      data:{
        title:'',
        slug:'',
        api_token:'{{Auth::user()->api_token}}',
        textPost:true,
        imgvidPost:false,
        fileName:"",
        fileSize:""

      },
      methods:{
        parentSlug:function(val){
          this.slug = val;
        },
        showTextPost:function(){
          this.textPost=true;
          this.imgvidPost=false;
        },
        showImgVidPost:function(){
          this.textPost=false;
          this.imgvidPost=true;
        },
        getFileName:function(){
          //console.log(this.$refs.fileSpecs);
          this.fileName = this.$refs.fileSpecs.files[0].name;
          this.fileSize = ((this.$refs.fileSpecs.files[0].size)/(1024*1024)).toFixed(2)+"MB";
          console.log(this.fileSize);
        }



      }
    });

  </script>

@endsection
