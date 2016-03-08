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
                        <input type="text" id="api_token" value="{{ $api_token }}" style="display:none;">
                        <!-- we have to get the api key here-->
                    </form>
                    <button class="btn btn-primary" id="addmovie">Add the movie</button>
                </div>
            </div>
        </div>
    </div>
    <!-- I know that jquery is being required in layout. but this is just temp til we know how we will link shit. -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script type="text/javascript">
        $('#addmovie').on('click', function(){
            // send the freaking data to the api with the token so that evryone is happy
        $.ajax({
            type: "POST",
            url: "api/addmovie",
            data: {'link': $('#link').val(), 'api_token': $('#api_token').val()},
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
    </script>
</div>
@endsection
