@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your settings</div>

                <div class="panel-body">
                    <div class="form-group">
                        <h3>Change your password:</h3>
                        <input type="password" id="oldpass"name="oldpass" value="" class="form-control">
                        <br>
                        <input type="password" id="newpass"name="newpass" value="" class="form-control">
                        <br>
                        <button type="button" id="changepassbutton"name="button" class="btn btn-default">Breyta lykilorði</button>
                    </div>
                    <div class="form-group">
                        <h3>Change your name:</h3>
                        <input type="text" id="name" name="name" value="" class="form-control">
                        <br>
                        <button type="button" id="chaneusersname"name="button" class="btn btn-default">Breyta Nafni</button>
                    </div>
                    <div class="form-group">
                        <h3>Change your username</h3>
                        <input type="text" id="username"name="username" value="" class="form-control">
                        <br>
                        <button type="button" id="changeusername"name="button" class="btn btn-default">change username</button>
                    </div>
                    <div class="form-group">
                        <h3>Change your email</h3>
                        <input type="email" id="email" name="email" value="" class="form-control">
                        <br>
                        <button type="button" id="changeemailbutton"name="button" class="btn btn-default">change email</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $( document ).ready(function(){
    var api_token = '{{ $api_token }}';
    $('#changepassbutton').on('click',function(){
      $.ajax({Request for package information failed: atom.io is temporarily unavailable, please try again later.
        type: "POST",
        url: '/api/changeuserpassword',
        data: {
          api_token: api_token,
          oldpass: $('#oldpass').val(),
          newpass: $('#newpass').val()
          }
        }).done(function(data){
          console.log(data);
          alert('success');
        });
    });
    $('#chaneusersname').on('click',function(){
      $.ajax({
        type: "POST",
        url: '/api/changeusersname',
        data: {
          api_token: api_token,
          name: $('#name').val()
          }
        }).done(function(data){
          console.log(data);
          alert('success');
        });
    });
    $('#changeusername').on('click',function(){
      $.ajax({
        type: "POST",
        url: '/api/changeusername',
        data: {
          api_token: api_token,
          username: $('#username').val()
          }
        }).done(function(data){
          console.log(data);
          alert('success');
        });
    });
    $('#changeemailbutton').on('click',function(){
      $.ajax({
        type: "POST",
        url: '/api/changeuseremail',
        data: {
          api_token: api_token,
          email: $('#email').val()
          }
        }).done(function(data){
          console.log(data);
          alert('success');
        });
    });
  });
</script>
@endsection
