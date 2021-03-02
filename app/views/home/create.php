<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/medivia/library/css/style.css">

		<title>Add a new Book</title>
	</head>
	<body>
		<div class='container'>
			<a class='logout' href='/medivia/library/login/logout'>Log out</a>
			<h1>Add a new Book</h1>
			<?php 
				if (!is_array($data)) {
					echo "<div class='alert alert-info' role='alert'>$data</div> <br/>";
				}
			?>
			<form action='' method='post' enctype='multipart/form-data'>
				<div class='form-group'>
					<label class='inputs'>Title: <input type='text' name='title' class='form-control'/></label>
				</div>
				<div class='form-group'>
					<label class='inputs'>Text: <textarea name='text' class='form-control overflow-auto' id='textarealarge' required></textarea></label>
				</div>
				<div class='form-group'>
					<label class='inputs'>Location: <input type='text' name='location' class='form-control'/></label>
				</div>
				<div class='form-group'>
					<label class='inputs'>Keywords: <input type='text' name='keywords' class='form-control'/></label>
				</div>
				<div class='form-group'>
					<label class='inputs'>Set: <input type='text' name='book_set' class='form-control'/></label>
				</div>
				<div class='form-group'>
					<label class='inputs'>Series: <input type='text' name='series' class='form-control'/></label>
				</div>
				<div class='form-group'>
					<label class='inputs'>Description: <input type='text' name='description' class='form-control'/></label>
				</div>
				<div class='form-group'>
					<label class='inputs'>Volume: <input type='number' name='volume' class='form-control'/></label>
				</div>

				<input type='file' name='file' id='file' class='hidden' style='display:none;' onchange='setPreviewImg(this)'/>
                <label for='file' class='btn btn-info'>Image</label>
				<img class='default-image' id='previewimg' src="/medivia/library/img/book.gif">
				
				<br><br>
				<input type='submit' name='action' value='Create' class='btn btn-primary'/>
				<a href='/medivia/library/home/index' class='btn btn-secondary'>Cancel</a>
			</form>			
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>		
		<script language="javascript" type="text/javascript" src="/medivia/library/js/script.js"></script>	
	</body>
</html>