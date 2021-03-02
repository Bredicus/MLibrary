<?php
/**
	@accessFilter:{LoginFilter}
 */
class HomeController extends Controller
{
	public function index() {	
		$this->model('Book');	
		if (isset($_POST['action'])) {
			$inputcategory = $_POST['inputcategory'];
			switch ($_POST['inputcategory']) {
				case 'Title':
					$BookList = Book::searchTitle($_POST['search']);				
					break;
				case 'Text':
					$BookList = Book::searchText($_POST['search']);
					break;
				case 'Location':
					$BookList = Book::searchLocation($_POST['search']);
					break;
				case 'Keyword':
					$BookList = Book::searchKeyword($_POST['search']);
					break;
				case 'Description':
					$BookList = Book::searchDescription($_POST['search']);
					break;
			}

			if ($_POST['search'] == "" || count($BookList) == 0) {
				$this->view('home/index', 'No search results');
			} else {
				$search = $_POST['search'];
				foreach ($BookList as $Book) {
					$Book->title = preg_replace("/($search)/i", "<mark>$1</mark>", $Book->title);
					$Book->text = preg_replace("/($search)/i", "<mark>$1</mark>", $Book->text);
					$Book->location = preg_replace("/($search)/i", "<mark>$1</mark>", $Book->location);
					$Book->keywords = preg_replace("/($search)/i", "<mark>$1</mark>", $Book->keywords);
					$Book->description = preg_replace("/($search)/i", "<mark>$1</mark>", $Book->description);
					$Book->book_set = preg_replace("/($search)/i", "<mark>$1</mark>", $Book->book_set);
				}

				$BookList[0]->displayText = "Searched all {$_POST['inputcategory']}s for '{$_POST['search']}'";
				
				$this->view('home/index', $BookList);
			}
		}	
		else {
			$BookList = Book::getMostRecent();
			if (!count($BookList) == 0) {
				$BookList[0]->displayText = 'Most recently added or edited Books';
			}		
			$this->view('home/index', $BookList);		
		}
	}

	public function create() {
		if (isset($_POST['action'])) {
			$newBook = $this->model('Book');
			$newBook->text = trim($_POST['text']);
			if ($this->duplicateCheck($newBook->text) > 0) {
				$this->view('home/create', 'This text already exists');
				return;
			}

			if ($_FILES['file']['error'] == 0) {
				$savePath = './img/';
				$fileExtenstion = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
				$fileName = uniqid() . '.' . $fileExtenstion;
	
				if ($fileExtenstion == 'jpg' || $fileExtenstion == 'png' || $fileExtenstion == 'jpeg' || $fileExtenstion == 'gif') {
					while (file_exists('img/' . $fileName)) {
						$fileName = uniqid() . '.' . $fileExtenstion;
					}
		
					if (move_uploaded_file($_FILES["file"]["tmp_name"], $savePath . $fileName)) {
						$newBook->picture_path = 'img/' . $fileName;
					}
				}
			}
			else {
				$newBook->picture_path = 'img/book.gif';
			}

            $newBook->created_by = $_SESSION['user_id'];
            $newBook->title = $_POST['title'];			
			$newBook->location = $_POST['location'];
            $newBook->keywords = $_POST['keywords'];
			$newBook->book_set = $_POST['book_set'];
			$newBook->series = $_POST['series'];
            $newBook->description = $_POST['description'];
			$newBook->volume = $_POST['volume'];

			$newBook->create();
			header('location:/medivia/library/home/index');
		}
		else {
			$this->view('home/create');
		}
	}
		
	public function edit($book_id) {
		$theBook = $this->model('Book')->find($book_id);

		if (isset($_POST['action'])) {
			$theBook->editBook($_SESSION['user_id']);

			if ($_FILES['file']['error'] == 0) {
				$savePath = './img/';
				$fileExtenstion = strtolower(pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION));
				$fileName = uniqid() . '.' . $fileExtenstion;
	
				if ($fileExtenstion == 'jpg' || $fileExtenstion == 'png' || $fileExtenstion == 'jpeg' || $fileExtenstion == 'gif') {
					while (file_exists('img/' . $fileName)) {
						$fileName = uniqid() . '.' . $fileExtenstion;
					}
		
					if (move_uploaded_file($_FILES["file"]["tmp_name"], $savePath . $fileName)) {						
						// if (!empty($theBook->picture_path) && $theBook->picture_path != 'img/book.gif' && file_exists($theBook->picture_path)) {
						// 	unlink($theBook->picture_path);
						// }
						$theBook->picture_path = 'img/' . $fileName;
					}
				}
			}

            $theBook->title = $_POST['title'];
			$theBook->text = trim($_POST['text']);
			$theBook->location = $_POST['location'];
            $theBook->keywords = $_POST['keywords'];
			$theBook->book_set = $_POST['book_set'];
			$theBook->series = $_POST['series'];
            $theBook->description = $_POST['description'];
			$theBook->volume = $_POST['volume'];

			$theBook->update($_SESSION['user_id']);
			header('location:/medivia/library/home/index');
		}
		else {
			if (empty($theBook) || !$theBook->is_enabled) {
				header('location:/medivia/library/home/index');
			} 
			else {
				$this->view('home/edit', $theBook);
			}
		}	
	}
		
	public function delete($book_id) {	
		$theBook = $this->model('Book')->find($book_id);

		if (isset($_POST['action'])) {
			// if (!empty($theBook->picture_path) && $theBook->picture_path != 'img/book.gif' && file_exists($theBook->picture_path)) {
			// 	unlink($theBook->picture_path);
			// }

			// $theBook->delete();
			$theBook->disable_book();
			header('location:/medivia/library/home/index');
		}
		else {
			if (empty($theBook) || !$theBook->is_enabled) {
				header('location:/medivia/library/home/index');
			} 
			else {
				$this->view('home/delete', $theBook);
			}
		}
	}

	private function duplicateCheck($text) {
		$this->model('Book');	
		return Book::checkIfTextExsists($text, strlen($text));
	}
}
?>