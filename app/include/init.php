<?php 

ob_start();
session_start();

include 'config.php';
include 'helper_function.php';





spl_autoload_register(function($className){
	include 'classes/' . $className . '.php';
});


	$album_obj = new Album;
	$artist_obj = new Artist;
	$song_obj = new Song;
	$genre_obj = new Genre;
	$playlist_obj = new Playlist;
	$user_obj = new User;
	$likes_obj = new Likes;







?>