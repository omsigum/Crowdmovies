@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form action="api/addmovie" method="POST" class="form-group">
                        <h1>Add a movie</h1>
                        <input type="text" id="link" placeholder="Insert direct link to IMDb" required class="form-control">
                        <br>
                        <input type="text" id="auto" name="name" placeholder="Search for a film" class="form-control">
                    </form>
                    <button class="btn btn-default" id="addmovie">Add the movie</button>
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
                      var response = data.Response;
                      if (response) {
                        var thing = data['Search'];
                        console.log(thing);
                        availableTags = [];
                          for (var i = 0; i < thing.length; i++) {
                            availableTags.push(thing[i].Title);
                          }
                        //console.log(availableTags);
                        completetheauto(thing);
                      }
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
          var completetheauto = function(imdblink){
            $( "#auto" ).autocomplete({
            	source: availableTags,
              select: function (e) {
                console.log(e);
                console.log(imdblink);
                var thelink = imdblink[0].imdbID;
                console.log(thelink);
                $('#link').val(thelink);
                return false;
              },
            });
          }
        })
    </script>
</div>
@endsection
