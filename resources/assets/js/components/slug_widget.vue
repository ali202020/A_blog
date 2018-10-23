<style scoped>
  .slug-widget
  {
    display:flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 30px;
  }

  .wrapper
  {
    margin-left: 5px;
  }

  .slug{
    background-color:#55efc4;
    padding:3px 0px;
  }

  .slug_input{
    width: auto;
  }

  .url-wrapper{
    display: flex;
    align-items: center;
    height: 28px;
  }

</style>




<template>
    <div class="slug-widget">

      <div class="icon-wrapper">
        <i class="fa fa-link"></i>
      </div>

      <div class="url-wrapper wrapper">
        <span class="root-url">{{url}}</span
        ><span class="subdirectory-url">/{{subdirectory}}/</span
        ><span class="slug" v-show="edit">{{slug}}</span
        ><span class="slug_input" v-show="!edit"><input type="text" v-model="slug"></span>
      </div>
      <div class="btn-wrapper wrapper">
        <button class="save-edit-btn is-small" v-show="!edit" @click.prevent="Save">Save</button>
        <button class="save-edit-btn is-small" v-show="edit" @click.prevent="Edit">Edit</button>
      </div>

    </div>
</template>

<script>
    export default {
        props:{
          url:{
            type:String,
            required:true
          },
          subdirectory:{
            type:String,
            required:true
          },
          title:{
            type:String,
            required:true
          },

        },

        data:function(){
          return {
            edit:true,
            token:this.$root.api_token,
            slug:this.slugSetVal(this.title), //this.convertTitle(),
          }
        },

        methods:{
            // convertTitle:function(){
            //   return this.title;
            // },
            Edit:function(){
              this.edit = false;
              this.slugSetVal(this.slug);
            },
            Save:function(){
              this.slug = Slug(this.slug);
              this.edit = true;
            },
            slugSetVal:function(slug_val){
              let current = this;
              let temp_slug = Slug(slug_val);
              //cheking the value to be found or not
              axios.get('/api/posts/unique',{
                params:{
                  api_token: current.token,
                  slug: temp_slug,
                },
              }).then(function(response){
                if (response.data == true) {
                  //True means that Slug is not unique (here my solution to make
                  // the url unique is to add the "unique" word to the url ...we
                  // might use numbers or count instead to be more practical)
                  current.slug = Slug(temp_slug +" "+"unique");
                }else{
                  //Assign the new value of the slug
                  current.slug = Slug(temp_slug);
                }
                //Then emit the result after that to parent
                current.$emit('pass-slug-to-parent',current.slug);


              })
              .catch(function(error){
                console.log(error);
              });


            }
        },
        watch:{
          title:_.debounce(
            function(){
              //this will convert the title and sets the slug initial
              //this will check the slug
              this.slugSetVal(this.title);
            },150),
        }

        // watch:{
        //   title:function(){
        //     this.slug = this.title;
        //   }
        //}


    }
</script>
