<?php
class Book extends Model
{
    var $book_id; //int
    var $created_by; //int
    var $created_on; //datetime
    var $last_edit_by; //int
    var $last_edit_on; //datetime
    var $title; //str
    var $text; //str
    var $location; //str
    var $keywords; //str
    var $picture_path; //str
    var $book_set; //str
    var $series; //str
    var $description; //str
    var $volume; //int


    public static function getMostRecent() {
        $SQL = 'SELECT * FROM Book WHERE is_enabled = 1 ORDER BY last_edit_on DESC';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute([]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $stmt->fetchAll();
    }

    public static function checkIfTextExsists($textStr, $textLen) {
        $SQL = 'SELECT * FROM (SELECT * FROM Book WHERE is_enabled = 1 AND LENGTH(text) = :textLen)BookList WHERE text = :textStr';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['textLen' => $textLen, 'textStr' => $textStr]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $stmt->rowCount();
    }    

    public static function searchTitle($search) {
        $SQL = 'SELECT * FROM Book WHERE is_enabled = 1 AND title LIKE :search';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['search' => '%' . $search . '%']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $stmt->fetchAll();
    } 

    public static function searchText($search) {
        $SQL = 'SELECT * FROM Book WHERE is_enabled = 1 AND text LIKE :search';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['search' => '%' . $search . '%']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $stmt->fetchAll();
    } 

    public static function searchLocation($search) {
        $SQL = 'SELECT * FROM Book WHERE is_enabled = 1 AND location LIKE :search';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['search' => '%' . $search . '%']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $stmt->fetchAll();
    } 

    public static function searchKeyword($search) {
        $SQL = 'SELECT * FROM Book WHERE is_enabled = 1 AND keywords LIKE :search';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['search' => '%' . $search . '%']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $stmt->fetchAll();
    } 

    public static function searchDescription($search) {
        $SQL = 'SELECT * FROM Book WHERE is_enabled = 1 AND description LIKE :search';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['search' => '%' . $search . '%']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $stmt->fetchAll();
    } 
    
    public function create() {
        $SQL = 'INSERT INTO Book(created_by, last_edit_by, title, text, location, keywords, picture_path, book_set, series, description, volume) 
            VALUE(:created_by, :created_by, :title, :text, :location, :keywords, :picture_path, :book_set, :series, :description, :volume)';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute([
            'created_by' => $this->created_by, 
            'title' => $this->title,
            'text' => $this->text,
            'location' => $this->location,
            'keywords' => $this->keywords,
            'picture_path' => $this->picture_path,
            'book_set' => $this->book_set,
            'series' => $this->series,
            'description' => $this->description,
            'volume' => $this->volume
        ]);
        return $stmt->rowCount();	
    } 

    public function find($book_id) {
        $SQL = 'SELECT * FROM Book WHERE book_id = :book_id';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['book_id' => $book_id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book');
        return $stmt->fetch();
    }    

    public function update($user_id) {
        date_default_timezone_set("Canada/Eastern");
        $SQL = 'UPDATE Book SET title = :title, 
                                text = :text, 
                                location = :location,
                                keywords = :keywords,
                                book_set = :book_set,
                                series = :series,
                                description = :description,
                                volume = :volume,
                                picture_path = :picture_path,
                                last_edit_on = :last_edit_on,
                                last_edit_by = :last_edit_by
                WHERE book_id = :book_id';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute([
            'book_id' => $this->book_id,
            'title' => $this->title,
            'text' => $this->text,
            'location' => $this->location,
            'keywords' => $this->keywords,
            'book_set' => $this->book_set,
            'series' => $this->series,
            'description' => $this->description,
            'volume' => $this->volume,
            'picture_path' => $this->picture_path,
            'last_edit_on' => date("Y-m-d H:i:s"),
            'last_edit_by' => $user_id
        ]);
        return $stmt->rowCount();	
    }

    public function delete() {
      $SQL = 'DELETE FROM Book WHERE book_id = :book_id';
      $stmt = self::$_connection->prepare($SQL);
      $stmt->execute(['book_id' => $this->book_id]);
      return $stmt->rowCount();	
    }

    public function disable_book() {
        $SQL = 'UPDATE Book SET is_enabled = 0 WHERE book_id = :book_id';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute(['book_id' => $this->book_id]);
        return $stmt->rowCount();	
      }

      public function editBook($user_id) {
        $SQL = 'INSERT INTO Book_Edit(book_id, created_by, title, text, location, keywords, picture_path, book_set, series, description, volume) 
            VALUE(:book_id, :created_by, :title, :text, :location, :keywords, :picture_path, :book_set, :series, :description, :volume)';
        $stmt = self::$_connection->prepare($SQL);
        $stmt->execute([
            'book_id' => $this->book_id,
            'created_by' => $user_id, 
            'title' => $this->title,
            'text' => $this->text,
            'location' => $this->location,
            'keywords' => $this->keywords,
            'picture_path' => $this->picture_path,
            'book_set' => $this->book_set,
            'series' => $this->series,
            'description' => $this->description,
            'volume' => $this->volume
        ]);
        return $stmt->rowCount();	
    } 
}
?>