<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Post</title>
	<link rel="stylesheet" href="">
</head>
<body>


	<h1>Post</h1>
	<?php 
	//$results = array('id'=>'1','title'=>'Running Queries','body'=>'Once you have configured your database connection, you may run queries using the DB class.Running A Select Query');
	//print_r($results);
	
       foreach($posts as $post){
        echo  '<li><a href="'.$post->$id.'">'.$post->$title.'</a></li>';
       }
	 ?>
</body>
</html>