@extends('layouts.app')

@section('content')
<div class="headerImage">
	<div class="overlay">

	</div>
</div>
<div class="container">
	<div class="mainCon col-md-9">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#info">General Information</a></li>
			<li><a data-toggle="tab" href="#comments">Comments</a></li>
			<li><a data-toggle="tab" href="#updates">Updates</a></li>
		</ul>
		<div class="tab-content">
			<div id="info" class="tab-pane fade in active">
				<div class="movieContainer">
					<img src="http://img.omdbapi.com/?apikey=899eace9&i=tt1856010&h=300">
					<div class="movieInfo">
						<div class="movieTitle">
							House of Cards
						</div>

						<div>
							<strong>Plot:</strong>
						</div>
						<div class="movieDescription">

						</div>
						<br>
						<div>
							<strong>Cast:</strong>
						</div>
						<div class="movieCast">

						</div>
					</div>
				</div>
			</div>
			<div id="comments" class="tab-pane fade">
				<h3>Comments</h3>
				<p>Here users will be able to post comments 'n stuff</p>
			</div>
			<div id="updates" class="tab-pane fade">
				<h3>Updates</h3>
				<p>If we have a problem, or if any important information regarding the movie comes to light, it will be accessible here.</p>
			</div>
		</div>
	</div>
	<div class="side col-md-3">
		<h3>Checking intrest</h3>
		<hr>
		<div class="interestContainer">
			<div class="numOfInterest">
				149/150
			</div>
			<span style="font-size: 1.4em;">supporters</span>
		</div>
		<hr>
		<div class="approvalContainer">
			More interest is needed to trigger the approval process
			<br>
			<br>
			You can help gather interest by sharing on facebook
		</div>
		<hr>

		<div class="ticketContainer">
			Once the film has been approved for showing tickets will be sold here
		</div>
		<hr>

	</div>
<div class="padding"></div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	var movie = {};
	$.getJSON('http://www.omdbapi.com/?i=tt1856010&plot=long&r=json', function(data) {
		console.log(data);
		$('.overlay').text(data.Title);
		$('.movieDescription').text(data.Plot);
		$('.movieCast').text(data.Actors);

	});
</script>