<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/medivia/library/css/style.css">

		<title>Home</title>
	</head>
	<body>
		<div class='container'>
			<a class='logout' href='/medivia/library/login/logout'>Log out</a>
			<h1>Medivia Digital Library</h1>
			<form action='' method='post'>
				<div class='input-group mb-3'>
					<div class='input-group-append'>
						<button type='submit' name='action' class='btn btn-primary' type='button' id='category'>Search Title</button>
						<button type="button" name='category' class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="javascript:searchCategoryChange('Title');">Title</a>
							<a class="dropdown-item" href="javascript:searchCategoryChange('Text');">Text</a>
							<a class="dropdown-item" href="javascript:searchCategoryChange('Location');">Location</a>
							<a class="dropdown-item" href="javascript:searchCategoryChange('Keyword');">Keyword</a>
							<a class="dropdown-item" href="javascript:searchCategoryChange('Description');">Description</a>
						</div>
					</div>
					<input type='text' class='form-control' name='search'>
					<input type='text' class='form-control' name='inputcategory' id='inputcategory' value='Title'>
				</div>
			</form>
			<a href='/medivia/library/home/create' class='btn btn-success'>Add a new Book</a>
			<br><br>
			<?php 
				if (!is_array($data)) {
					echo "<div class='alert alert-info' role='alert'>$data</div> <br/>";
				}
				
				if (is_array($data) && !empty($data)) {
					$displayText = $data[0]->displayText;
					echo "<h4>$displayText</h4>";
					echo "<div class='overflow-auto cards-main'>";

					foreach ($data as $book) {
					echo "
						<div class='book-card l-m-t' id='div_id_$book->book_id'>
						<table class='table'>
						<tr>
						<td>
						<input type='checkbox' class='m-m-l' id='checkbox_$book->book_id' onclick='checkBoxChange(\"$book->book_id\")'>
						<label class='form-check-label m-m-l' for='checkbox_$book->book_id'>Show More</label>
						</td>
						<td><button type='button' class='btn btn-secondary btn-width' onclick='divHide(\"div_id_$book->book_id\")'>Remove</button></td>
						<td><a href='/medivia/library/home/edit/$book->book_id' class='btn btn-info btn-width'>Edit</a></td>
						<td><a href='/medivia/library/home/delete/$book->book_id' class='btn btn-danger btn-width'>Delete</a></td>
						</tr>
						<tr>
						<td><img class='default-image s-m-t' src='/medivia/library/$book->picture_path'></td>
						<td colspan='3'><h6 class='m-m-t'>$book->title</h6></td>
						</tr>
						<tr>
						<td colspan='4'><div class='book-text'>$book->text</div></td>
						</tr>
						<tr>
						<td colspan='4'><p><b>Location:</b> $book->location<p></td>
						</tr>
						<tr>
						<td colspan='4'><p><b>Keywords:</b> $book->keywords<p></td>
						</tr>
						</table>

						<div id='div_hide_$book->book_id' style='display: none;'>
						<table class='table'>
						<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
						<tr>
						<td colspan='8'><p><b>Description:</b> $book->description<p></td>
						</tr>
						<tr>
						<td colspan='8'><p><b>Set:</b> $book->book_set<p></td>
						</tr>
						<tr>
						<td colspan='7'><p><b>Series:</b> $book->series<p></td>
						<td colspan='1'><p><b>Volume:</b> $book->volume<p></td>							
						</tr>
						</table>
						</div>							
						</div>
					";							
					}
					echo "</div>";
				}
			?>  
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>	
		<script language="javascript" type="text/javascript" src="/medivia/library/js/script.js"></script>	
	</body>
</html>