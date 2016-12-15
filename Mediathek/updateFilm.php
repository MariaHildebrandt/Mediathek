<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'classes/Film.php';
	require_once 'classes/Poster.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$filmID = $_GET['edit_id'];
		
		$showFilm = new Film;
		$filmValues= $showFilm->getValues($filmID); //Entnimmt DB-Einträge aus Tabelle tbl_films
		
		$poster = new Poster;
		$posterForFilm = $poster->getPoster($filmID); //Entnimmt DB-Eintrage aus Tabelle tbl_posters für filmID
		
	}
	else
	{
		header("Location: index.php");
	}
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$filmDirector = $_POST['director'];
		$filmTitle = $_POST['title'];
		$filmGenre = $_POST['genre']; 
		$filmDesc = $_POST['description'];
			
		$imgFile = $_FILES['poster']['name'];
		$tmp_dir = $_FILES['poster']['tmp_name'];
		$imgSize = $_FILES['poster']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'film_poster/';
			
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));  //Dateiformat
			
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
			
			$filmPic = $imgFile;
			
			/*
			* Prüft Format
			* und Größe der Datei
			*/
			
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$posterForFilm[0]['poster']); 
					move_uploaded_file($tmp_dir,$upload_dir.$filmPic);
				}
				else
				{
					$errMSG = "Datei darf nicht gr&ouml;&szlig;er als 5MB sein.";
				}
			}
			else
			{
				$errMSG = "Nur JPG, JPEG, PNG & GIF.";		
			}	
		}
		else
		{
			$filmPic  = $posterForFilm[0]['poster']; //wenn kein neues bild hochgeladen -> vorhandenes ünernehmen
		}	
		
						
		/* Wenn alles geprüft wurde,
		* können die neuen Information übertragen werden
		*/
		if(!isset($errMSG))
		{  
			$updateFilm = new Film;
			$updateFilm->update($filmID,$filmTitle,$filmDirector,$filmGenre,$filmDesc);
			
			$updatePoster = new Poster;
			$updatePoster->update($filmPic,$filmID); 
			header ('Location: films.php');
		}
				
	}
	
?>



<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include('view/partials/head.php'); ?>
  </head>
  <body>
  <?php include('view/partials/nav.php'); ?>
   
   <div id="wrap">
		<div id="main" class="container clear-top">
			<div class="row">
				<div class="col-sm-2"></div> <!--offset -->
				<div class="col-sm-8">
				
					<div class="page-header">
						<h1 class="h2">Film editieren  
							<a class="btn btn-default" href="films.php"> 
								<span class="glyphicon glyphicon-eye-open"></span> &nbsp; Alle Filme anzeigen 
							</a> 
						</h1>
					</div>
					
					<!--
					-- Update Formular
					-->
					<form method="post" enctype="multipart/form-data" class="form-horizontal" id="updateBook">
					
						<!--
						-- Error Messages
						-->
						
						<?php if(isset($errMSG)){ ?>
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
							</div>
						<?php } ?>
						
						<!--
						-- Ende Error Messages, Begin EingabeFelder
						-->
					
						<div class="form-group">
							<label for="title">Titel</label>
							<input type="text" class="form-control" id="title" name ="title" value="<?php echo $filmValues[0]['filmTitle']; ?>" />
						</div>
					  
						<div class="form-group">
							<label for="director">Director</label>
							<input type="text" class="form-control" id="director" name = "director" value="<?php echo $filmValues[0]['filmDirector']; ?>" />
						</div>
					  
						<div class="form-group">
							<label for="genre">Genre</label>
							<select class="form-control" id="genre" name = "genre" value="<?php echo $filmValues[0]['filmGenre']; ?>">
							  <option value = "action">Action</option>
							  <option value = "thriller">Thriller</option>
							  <option value = "fantasy">Fantasy</option>
							  <option value = "mystery">Mystery</option>
							  <option value = "none">keine Kategorie</option>
							</select>
						</div>
					  
						 <div class="form-group">
							<label for="description">Beschreibung</label>
							<textarea class="form-control" id="description" name = "description" placeholder="darf leer bleiben" rows="3" value="<?php echo $filmValues[0]['filmDesc']; ?>" ></textarea>
						 </div>
					  
						 <div class="form-group">
							<label for="poster"  class="control-label">Bild hinzufügen</label>
								<p>
									<img src="film_poster/<?php echo $posterForFilm[0]['poster']; ?>" height="350" width="250" />
								</p>
							 <input class="input-group" type="file" id = "poster" name="poster" accept="image/*" />
						 </div>
					  
						 <button type="btn_save_updates" name= "btn_save_updates" class="btn btn-primary">Save</button>
					  
					  
					</form>
					<!--
					-- Ende Update Formular
					-->
	  
				</div><!--Ende von col-8-->
				<div class="col-sm-2"></div>
			
		
			</div> <!--Ende div class row -->
		</div> <!--Ende container -->
	</div><!-- Ende wrap -->
	
    <footer class="footer"><?php include('view/partials/footer.php'); ?></footer>
    <?php include('view/partials/scripts.php'); ?>
   
  </body>
</html>	