<?php

$connection = koneksiToMysql("localhost", "root", "", "sistemiot");

function koneksiToMysql($lokasiserver, $username, $password, $namadatabase){
	$conn = mysqli_connect($lokasiserver, $username, $password, $namadatabase);
	return $conn;
}