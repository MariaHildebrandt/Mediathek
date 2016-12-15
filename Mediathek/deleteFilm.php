<?php

	require_once 'classes/Poster.php';
	require_once 'classes/Film.php';
	
	if(isset($_GET['delete_id']))
	{
		$filmID = $_GET['delete_id'];
		
		$upload_dir = 'film_poster/';
		
		$deletePoster = new Poster;
		$delete = $deletePoster->getPoster($filmID); 
		
		//bilddatei aus Pfad film_poster entfernen
		unlink($upload_dir.$delete[0]['poster']); 
		//aus DB entfernen
		$deletePoster->remove($filmID); 
		
		//Bilddatei muss vor DB-Film-Eintrag gelöscht werden
		//da in tbl_posters die zugehörige filmID hinterlegt ist
		$deleteFilm = new Film;
		$deleteFilm->remove($filmID);
		
		header("Location: films.php");
	}

?>