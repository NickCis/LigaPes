<?php
// Copyright 2007 Facebook Corp.  All Rights Reserved. 
// 
// Application: Liga Pes
// File: 'index.php' 
//   This is a sample skeleton for your application. 
// 

require_once 'facebook-platform/php/facebook.php';

$appapikey = 'e30aa3a25f0935fb174a310a4ca4b6e4';
$appsecret = 'b99d155dbe36e825aece92b85770d9f1';
$facebook = new Facebook($appapikey, $appsecret);
$user_id = $facebook->require_login();

// Greet the currently logged-in user!
echo "<p>Hello, <fb:name uid=\"$user_id\" useyou=\"false\" />!</p>";

// Print out at most 25 of the logged-in user's friends,
// using the friends.get API method
echo "<p>Friends:";
$friends = $facebook->api_client->friends_get();
$friends = array_slice($friends, 0, 25);
foreach ($friends as $friend) {
  echo "<br>$friend";
}
echo "</p>";
