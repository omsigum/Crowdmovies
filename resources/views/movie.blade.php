@extends('layouts.app')

@section('content')
<div class="headerImage" style="background-image: url('{{ $movies -> banner }}');">
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
					<img id="poster"src="">				<!-- Here comes the link-->
					<div class="movieInfo">
						<div class="movieTitle">
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
						<!-- All of the comments in a li-->
						<!-- If the user has not logged in then show some shit. Else render the add comment button. -->
						<ul id="commentscontainer">

						</ul>
						@if (Auth::guest())
							<p>
								Comments can only be posted once logged in.
							</p>
						@else
							<div class="form-group">
								<textarea placeholder="What do you have to say?" id="commentcontent" class="form-control" rows="4"></textarea>
								<button type="button"id="addcomment" name="button" class="btn btn-default" >Add comment</button>
							</div>
						@endif
			</div>
			<div id="updates" class="tab-pane fade">
				<h3>Updates</h3>
				<p>If we have a problem, or if any important information regarding the movie comes to light, it will be accessible here.</p>
				@if(Auth::isAdmin())
				<input type="text" id="updatetitle" placeholder="The Title">
				<input type="text" id="updatecontent" placeholder="The content....">
				<button type="button" id="updatebutton"name="button">Add updates</button>
				@endif
			</div>
		</div>
	</div>
	<div class="side col-md-3">
		<h3>Checking intrest</h3>
		<hr>
		<div class="interestContainer">
			<div class="numOfInterest">
				{{ $movies -> numberofpintrested }}/150
			</div>
			<span style="font-size: 1.4em;">supporters</span>
			@if(Auth::isintrested($movies -> ID))
				<p>
					You have already shown support for this movie
				</p>
			@else
				@if(Auth::guest())
					<p>
						Login to show support.
					</p>
				@else
						<button type="button" name="button" id="showsupport">Show support for this movie</button>
				@endif
			@endif
		</div>
		<hr>
		<div class="approvalContainer">
			@if(Auth::isinapproval($movies -> ID))
			The movie is in a approval state. hang tight
			@else
			More interest is needed to trigger the approval process
			@endif
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	var movie = {};
	$.getJSON('http://www.omdbapi.com/?i=<?php echo $movies -> IMDB ?>&plot=long&r=json', function(data) {
		$('.overlay').text(data.Title);
		$('.movieDescription').text(data.Plot);
		$('.movieCast').text(data.Actors);
		$('#poster').attr('src',data.Poster);
		$('.movieTitle').text(data.Title);
	});
</script>
<script type="text/javascript">
		$(document).ready(function(){
			// fetch the like user data and like stuff u know. only enable the submission if the user is logged in.
			var appendelement = $('#commentscontainer');
			var submissionID = '{{ $movies -> ID }}';
			var api_token = '{{ $movies -> api_token }}';
			// fetch the comments
			var fetchcomments = function(){
				$.ajax({
					type: "POST",
					url: '/api/fetchcomments',
					data: {
						submissionID: submissionID
						}
					}).done(function(data){
						var comments = data;
						var output = "";
						for (var i = 0; i < comments.length; i++) {
							output += "<li class=\"comment\">" + comments[i].content + "<span>"+comments[i].name+"</span></li>";
						}
						appendelement.html(output);
					});
			};

				// check if the add comment button is pushed
				$('#addcomment').on('click',function(){
					// the fetch movie needs submissionID api_token and the conent.
					var content = $('#commentcontent').val();
					console.log(content);
					$.ajax({
				  	type: "POST",
				  	url: '/api/addcomment',
				  	data: {
							submissionID: submissionID,
							content: content,
							api_token: api_token
							}
						}).done(function(data){
								// here is done
								console.log(data);
								fetchcomments();
						});
				})
				fetchcomments();
				$('#showsupport').on('click',function(){
					$.ajax({
				  	type: "POST",
				  	url: '/api/showintrest',
				  	data: {
							submissionID: submissionID,
							api_token: api_token
							}
						}).done(function(data){
								// here is done
								alert('Thanks for showing your support');
								location.reload();
						});
				});
		})
</script>
@endsection
