<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>profile</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php print_r($user);
      
      foreach($user as $data){
      	echo '<br>'.$data.'<br>';
      }

	 ?>
</body>
</html>