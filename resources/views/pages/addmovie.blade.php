@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form action="api/addmovie" method="POST">
                        <h1>Add a movie</h1>
                        <input type="text" id="link" placeholder="imdb link" required>
                        <input type="text" id="auto" name="name" placeholder="serach for movie">
                    </form>
                    <button class="btn btn-primary" id="addmovie">Add the movie</button>
                </div>
            </div>
        </div>
    </div>
    <!-- I know that jquery is being required in layout. but this is just temp til we know how we will link shit. -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          var api_token = '{{ $api_token }}';
          console.log(api_token);
          var availableTags = [];
          $('#auto').on('keydown',function(){
            // get the movies that match the search params the user provided
            var text = $('#auto').val();
            console.log(text);
            if (text.length >= 3) {
              $.ajax({
                  type: "GET",
                  url: "http://www.omdbapi.com/?s="+ text +"&y=&plot=short&r=json",
                  success:  function(data){
                      console.log(data);
                      var thing = data['Search'];
                      console.log(thing);
                      availableTags = [];
                      if (availableTags.length == 1) {
                        // the user has found the movie
                        $('#link').val(thing.imdbID);
                        console.log(thing.imdbID);
                      }
                      else if(data.Response == "True") {
                        for (var i = 0; i < thing.length; i++) {
                          availableTags.push(thing[i].Title);
                        }
                      }
                      console.log(availableTags);
                      completetheauto();
                  },
                  });
            }
          })
          $('#addmovie').on('click', function(){
            var link = $('#link').val();
            $('#link').val('');
          $.ajax({
              type: "POST",
              url: "api/addmovie",
              data: {link: link, api_token: api_token},
              success:  function(data){
                  console.log(data);
                  if (data == 1) {
                      alert('worked');
                  }
                  else{
                      alert('nob nob');
                  }
              },
              });
          });
          var completetheauto = function(){
            $( "#auto" ).autocomplete({
            	source: availableTags
            });
          }
        })
    </script>
</div>
@endsection
