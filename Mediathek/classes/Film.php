<?php

require_once 'Database.php';
class Film 
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
	
    public function insert($filmTitle,$filmDirector,$filmGenre,$filmDesc)
	{
	    try
        { 
            $stmt = $this->conn->prepare("INSERT INTO tbl_films(filmTitle,filmDirector,filmGenre,filmDesc) 
                                                VALUES(:filmDirector, :filmTitle, :filmGenre, :filmDesc)");
            $stmt->bindparam(":filmDirector",$filmDirector);
            $stmt->bindparam(":filmTitle",$filmTitle);
            $stmt->bindparam(":filmGenre",$filmGenre);
            $stmt->bindparam(":filmDesc",$filmDesc);
            $stmt->execute(); 
            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
    public function update($filmID,$filmTitle,$filmDirector,$filmGenre,$filmDesc)
	{
	    try
		{
		    $stmt = $this->conn->prepare('UPDATE tbl_films 
									     SET filmDirector=:filmDirector,
											 filmTitle=:filmTitle,
											 filmGenre=:filmGenre,
										     filmDesc=:filmDesc 
								       WHERE filmID=:filmID;');
									   
		    $stmt->bindparam(":filmDirector",$filmDirector);
            $stmt->bindparam(":filmTitle",$filmTitle);
            $stmt->bindparam(":filmGenre",$filmGenre);
            $stmt->bindparam(":filmDesc",$filmDesc);
			$stmt->bindParam(':filmID',$filmID);
			$stmt->execute();
		}
		catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
	
	public function getValues($filmID)
	{
	    try
		{
		    $stmt = $this->conn->prepare('SELECT * FROM tbl_films WHERE filmID=:filmID;');
			$stmt->bindParam(':filmID', $filmID);
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
			$sql = "SELECT * FROM tbl_films ORDER BY filmID DESC LIMIT ".$quantity;
		}
		else {
			$sql = "SELECT * FROM tbl_films ORDER BY filmTitle DESC";
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
	
	
	public function getNewestID() //zuletzt eingefügte ID - dient als REID für zugehöriges Bild
	{
	    try
        {
            $stmt = $this->conn->prepare("SELECT filmID FROM tbl_films ORDER BY filmID DESC LIMIT 1");
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
	
    public function remove($filmID)
	{
	    try
        {
            $stmt = $this->conn->prepare("DELETE FROM tbl_films WHERE filmID = :filmID");
			$stmt->bindParam(':filmID', $filmID);
            $stmt->execute();
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}
}