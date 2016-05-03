@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <?php foreach ($movies as $key) {
        $otput = '<a href="/movie/'.$key -> IMDB.'"><div class="movieTile col-md-3"><div class="image"><img src="'.$key -> posterUrl.'"><span class="imdbrating">'.$key -> imdbRating.'<img src="/img/IMDb_Logo.png" \></span><rt></rt></div></div></a>';
        echo $otput;
    } ?>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
        $( document ).ready(function() {
             $('.image').each(function(){
            console.log('hey');
            var width = $(this).children('img').width();
            console.log(width);
            $(this).width(width);
            });
        });

</script>
