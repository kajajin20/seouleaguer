<?php
class facebook extends Controller
{
	public function index()
	{
		require 'application/views/facebook/index.php';
	}

	public function timeline(){
		require 'application/views/facebook/timeline.php';
	}
}
