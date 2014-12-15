@extends('_master')

@section('title')
	Welcome to PawBook!!!
@stop

@section('content')
	<h1>
	    @if(Session::get('flash_message'))
	        <div class='welcome-message'>{{ Session::get('flash_message').'&nbsp;'.Auth::user()->name.'!' }}</div>
	    @endif
	</h1>

	@if(Auth::check())
                <h3>What do you want to do today?</h3>
                <ul>
	                <li><a href="/pet">See my pets</a></li>
	                <li><a href="/pet/create">Add a pet</a></li>
	            </ul>
            @else 
            	<div class="col-lg-5 col-centered">
	            	<img src="img/logo.png" />
	            </div>
	            <h2 class="text-center"><a href="/user/signup">Signup</a> or <a href="/user/login">Login</a> to get started.</h2>
            @endif
	@stop