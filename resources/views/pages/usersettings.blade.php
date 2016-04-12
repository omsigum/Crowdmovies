@extends('layouts.app')

@section('content')
This page is like for settings and stuff. Jeee
<div class="">
 Password Change
 <input type="password" id="oldpass"name="oldpass" value="">
 <input type="password" id="newpass"name="newpass" value="">
 <button type="button" id="changepassbutton"name="button">Breyta lykilorði</button>
</div>
<div class="">
 Name change
 <input type="text" id="name" name="name" value="">
  <button type="button" id="chaneusersname"name="button">Breyta Nafni</button>
</div>
<div class="">
  username change
  <input type="text" id="username"name="username" value="">
   <button type="button" id="changeusername"name="button">change username</button>
</div>
<div class="">
  email change
<input type="email" id="email" name="email" value="">
 <button type="button" id="changeemailbutton"name="button">change email</button>
</div>
<script type="text/javascript">
  $( document ).ready(function(){
    var api_token = '{{ $api_token }}';
    $('#changepassbutton').on('click',function(){
      $.ajax({
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
