<?php

require_once 'Database.php';
class Book 
{
	private $conn;
 
    public function __construct()
    {
        $database = new Database();
	    $db = $database->dbConnection();
	    $this->conn = $db;
    }
 
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
	
    public function insert($bookAuthor,$bookTitle,$bookCategory,$bookDesc)
	{
	    try
        { 
            $stmt = $this->conn->prepare("INSERT INTO tbl_books(bookTitle,bookAuthor,bookCategory,bookDesc) 
                                                VALUES(:author, :title, :category, :description)");
            $stmt->bindparam(":author",$bookAuthor);
            $stmt->bindparam(":title",$bookTitle);
            $stmt->bindparam(":category",$bookCategory);
            $stmt->bindparam(":description",$bookDesc);
            $stmt->execute(); 
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
    public function update($bookID,$bookAuthor,$bookTitle,$bookCategory,$bookDesc)
	{
	    try
		{
		    $stmt = $this->conn->prepare('UPDATE tbl_books 
									     SET bookAuthor=:bookAuthor,
											 bookTitle=:bookTitle,
											 bookCategory=:bookCategory,
										     bookDesc=:bookDesc 
								       WHERE bookID=:bookID;');
									   
		    $stmt->bindParam(':bookAuthor',$bookAuthor);
			$stmt->bindParam(':bookTitle',$bookTitle);
			$stmt->bindParam(':bookCategory',$bookCategory);
			$stmt->bindParam(':bookDesc',$bookDesc);
			$stmt->bindParam(':bookID',$bookID);
			$stmt->execute();
		}
		catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
	public function getValues($bookID)
	{
	    try
		{
		    $stmt = $this->conn->prepare('SELECT * FROM tbl_books WHERE bookID=:bookID;');
			$stmt->bindParam(':bookID', $bookID);
			$stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
            if($stmt->rowCount() > 0 )
            {
                return $result;
            }
            else
            {
                header("Location: index.php?error");
                exit;
            }  
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
    public function show($quantity)
	{
		if(is_numeric($quantity)){
			$sql = "SELECT * FROM tbl_books ORDER BY bookID DESC LIMIT ".$quantity;
		}
		else {
			$sql = "SELECT * FROM tbl_books ORDER BY bookTitle DESC";
		}
	    try
        {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
            if($stmt->rowCount() > 0 )
            {
                return $result;
            }
			elseif($stmt->rowCount() == 0){echo "Keine Bücher gespeicert";}
            else
            {
                header("Location: index.php?error");
                exit;
            }  
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
	
	public function getNewestID() //zuletzt eingefügte ID - dient als REID für zugehöriges Bild
	{
	    try
        {
            $stmt = $this->conn->prepare("SELECT bookID FROM tbl_books ORDER BY bookID DESC LIMIT 1");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
            if($stmt->rowCount() > 0 )
            {
                return $result;
            }
            else
            {
                header("Location: index.php?error");
                exit;
            }  
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
    public function remove($bookID)
	{
	    try
        {
            $stmt = $this->conn->prepare("DELETE FROM tbl_books WHERE bookID = :bookID");
			$stmt->bindParam(':bookID', $bookID);
            $stmt->execute();
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
}