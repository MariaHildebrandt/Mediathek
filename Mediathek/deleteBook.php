<?php

	require_once 'classes/Picture.php';
	require_once 'classes/Book.php';
	
	if(isset($_GET['delete_id']))
	{
		$bookID = $_GET['delete_id'];
		
		$upload_dir = 'book_images/';
		
		$deletePicture = new Picture;
		$delete = $deletePicture->getPicture($bookID); 
		
		//bilddatei aus Pfad book_images entfernen
		unlink($upload_dir.$delete[0]['picture']); 
		//aus DB entfernen
		$deletePicture->remove($bookID); 
		
		//Bilddatei muss vor DB-Book-Eintrag gelöscht werden
		//da in tbl_posters die zugehörige bookID hinterlegt ist
		$deleteBook = new Book;
		$deleteBook->remove($bookID);
		
		header("Location: books.php");
	}

?>