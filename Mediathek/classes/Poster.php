<?php

require_once 'Database.php';
class Poster 
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
	
    public function insert($poster, $filmID)
	{
	    try
        { 
            $stmt = $this->conn->prepare("INSERT INTO tbl_posters(poster,filmID) 
                                                VALUES(:poster,:filmID)");
            $stmt->bindParam(':poster', $poster);
			$stmt->bindparam(":filmID",$filmID);
            $stmt->execute(); 
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
    public function update($poster,$filmID)
	{
	    try
		{
		    $stmt = $this->conn->prepare('UPDATE tbl_posters 
									     SET poster=:poster
								       WHERE filmID=:filmID;');
									   
		    $stmt->bindParam(':poster', $poster);
            $stmt->bindParam(':filmID', $filmID);
			$stmt->execute();
		}
		catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
	
    public function getPoster($filmID)
	{
	    try{
		   $stmt = $this->conn->prepare("SELECT * FROM tbl_posters WHERE filmID = :filmID;");
		   $stmt->bindParam(':filmID', $filmID);
           $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
            if($stmt->rowCount() > 0 )
            {
                return $result;
            }
			elseif($stmt->rowCount() == 0){echo "Keine Filme gespeicert";}
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
	

	
	
    public function remove($filmID)
	{
	    try
        {
            $stmt = $this->conn->prepare("DELETE FROM tbl_posters WHERE filmID = :filmID;");
			$stmt->bindParam(':filmID', $filmID);
            $stmt->execute();
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
}