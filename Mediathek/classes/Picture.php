<?php

require_once 'Database.php';
class Picture 
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
	
    public function insert($picture, $bookID)
	{
	    try
        { 
            $stmt = $this->conn->prepare("INSERT INTO tbl_pictures(picture,bookID) 
                                                VALUES(:picture,:bookID)");
            $stmt->bindParam(':picture', $picture);
			$stmt->bindparam(":bookID",$bookID);
            $stmt->execute(); 
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
    public function update($picture,$bookID)
	{
	    try
		{
		    $stmt = $this->conn->prepare('UPDATE tbl_pictures 
									     SET picture=:picture
								       WHERE bookID=:bookID;');
									   
		    $stmt->bindParam(':picture', $picture);
            $stmt->bindParam(':bookID', $bookID);
			$stmt->execute();
		}
		catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
	
    public function getPicture($bookID)
	{
	    try{
		   $stmt = $this->conn->prepare("SELECT * FROM tbl_pictures WHERE bookID = :bookID;");
		   $stmt->bindParam(':bookID', $bookID);
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
	

	
	
    public function remove($bookID)
	{
	    try
        {
            $stmt = $this->conn->prepare("DELETE FROM tbl_pictures WHERE bookID = :bookID;");
			$stmt->bindParam(':bookID', $bookID);
            $stmt->execute();
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
}