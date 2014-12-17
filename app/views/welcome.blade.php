@extends('_master')

@section('title')
	Welcome to PawBook!!!
@stop

@section('content')
	<h1>
	    @if(Session::get('flash_message'))
	    	<div class='flash-message'>{{ Session::get('flash_message') }}</div>
        @elseif(Session::get('confirm_message'))
            <div class='confirm-message'>{{ Session::get('confirm_message').'&nbsp;'.Auth::user()->name.'!' }}</div>
	    @endif
	</h1>

	@if(Auth::check())
            <h3>What do you want to do today?</h3>
            <ul>
                <li><a href="/pet">See my pets</a></li>
                <li><a href="/pet/create">Add a pet</a></li>
            </ul>
        @else 
        	<img class="logo" src="img/logo.png" />
            <h2 class="text-center"><a href="/user/signup">Signup</a> or <a href="/user/login">Login</a> to get started.</h2>
        @endif
	@stop