/******************************************************
***********  Search Bar Based On AJAX  ****************
*******************************************************/

//Intiating the request on keyup event Or Retrieving Results Back on 'Focus on' the input field
//----------------------------------------------------------------------------------------------
$('.search-bar').on('keyup focusin',_.debounce(function(){
    var search_key  = String($(this).val());
    //Limitting initiating search triger for specified cumber of characters
    if(search_key.length >= 3)
    {
      axios.get('/api/posts/'+search_key)
           .then(function(response){
             var i;
             //Clearing -initializing- Search result list before any new request
             $('.search-results').empty();
             for(i=0;i<response.data.length;i++){
               //console.log(response.data[i].title);
               var title = String(response.data[i].title);                                          //The purpose of 'String' is Ensuring that the value is String
               var highlightedSk = "<span>"+search_key+"</span>";            //highlighted search key
               var highlightedSr = title.toLowerCase().replace(search_key,highlightedSk);           //highlighted search result  ... we used to lower case to make search or replace process case insensitive
               $('.search-results').append('<li class="panel-block"><a href="/manage/posts/'+response.data[i].slug+'">'+highlightedSr+'</a></li>');
               //$('.search-results').append('<li class="panel-block"><a href="/manage/posts/'+response.data[i].slug+'">'+response.data[i].title.toLowerCase().replace(search_key,"<span style='color:red;'>"+search_key+"</span>")+'</a></li>');
             }
           })
           .catch(function(error){
             console.log(error);
           });
    }
    //Clearing -initializing- Search result is there is no input or input has been cleared
    if(search_key.length == 0){
      $('.search-results').empty();
    }
    //Clearing -initializing- Search result is search key < 3 chars
    if(search_key.length < 3){
      $('.search-results').empty();
    }
  },100));

//Clearing -initializing- Search result when Search bar is blur
//-------------------------------------------------------------
$('.search-bar').focusout(_.debounce(function(){
  $('.search-results').empty();
},100));



//event bubbling???!!!
// $(document).click(function(){
//   $('.search-results').empty();
// });
