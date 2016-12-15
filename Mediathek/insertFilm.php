<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'classes/Film.php';
	require_once 'classes/Poster.php';
	
	
	if(isset($_POST['submit']))
	{
		$filmDirector = $_POST['director'];
		$filmTitle = $_POST['title'];
		$filmGenre = $_POST['genre']; 
		$filmDesc = $_POST['description'];
		
		$imgFile = $_FILES['poster']['name'];
		$tmp_dir = $_FILES['poster']['tmp_name'];
		$imgSize = $_FILES['poster']['size'];
		
		if(empty($filmDirector)){
			$errMSG = "Bitte tragen Sie den Namen des Directors ein.";
		}
		elseif(empty($filmTitle)){
			$errMSG = "Bitte tragen sie den Filmtitel ein.";
		}
		elseif(empty($imgFile)){
			$errMSG = "Bitte wählen sie ein Bild.";
		}
		else 
		{
			$upload_dir = 'film_poster/'; 
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get picture extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
			$filmpic = $imgFile; 
			
			if(in_array($imgExt, $valid_extensions)){			
				// Datei größe <'5MB'
				if(($pictureSize < 5000000)){
					move_uploaded_file($tmp_dir,$upload_dir.$filmpic);
				}
				else{
					$errMSG = "Datei darf nicht gr&ouml;&szlig;er als 5MB sein.";
				}
			}
			else{
				$errMSG = "Nur JPG, JPEG, PNG & GIF.";		
			}
		}
		 
		if(!isset($errMSG))
		{
			$newFilm = new Film;
			$newFilm->insert($filmTitle,$filmDirector,$filmGenre,$filmDesc);
			
			$filmID=$newFilm->getNewestID();
			$entry = $filmID[0]['filmID'];
			
			$newPoster = new Poster;
			$newPoster->insert($filmpic,$entry);
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
			
				<div class="col-sm-2"></div>
				
				<div class="col-sm-8">
				
					<div class="page-header">
						<h1 class="h2">Alle Filme / Neuen Film hinzufügen  
							<a class="btn btn-default" href="films.php"> 
								<span class="glyphicon glyphicon-eye-open"></span> &nbsp; Alle Filme anzeigen 
							</a> 
						</h1>
					</div>
					
						<!-- 
						-- Error Message
						-->
						<?php if(isset($errMSG)){ ?>
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
							</div> 
						<?php } ?>
						<!-- 
						-- Ende Error Message
						-->
						
					<!-- 
					-- Eingabe Formular
					-->
					
					<form method="post" enctype="multipart/form-data" class="form-horizontal"  id="newFilm">
					
						 <div class="form-group">
							<label for="title">Titel</label>
							<input type="text" class="form-control" id="title" name ="title" placeholder="">
						 </div>
					  
						 <div class="form-group">
							<label for="director">Director</label>
							<input type="text" class="form-control" id="director" name = "director" placeholder="">
						 </div>
					  
						 <div class="form-group">
							<label for="genre">Genre</label>
							<select class="form-control" id="genre" name = "genre">
								 <option value = "action">Action</option>
								 <option value = "thriller">Thriller</option>
								 <option value = "fantasy">Fantasy</option>
								 <option value = "mystery">Mystery</option>
								 <option value = "none">keine Kategorie</option>
							</select>
						 </div>
					  
						 <div class="form-group">
							<label for="description">Beschreibung</label>
							<textarea class="form-control" id="description" name = "description" placeholder="darf leer bleiben" rows="3"></textarea>
						 </div>
					  
						 <div class="form-group">
							<label for="poster"  class="control-label">Bild hinzufügen</label>
							<input class="input-group" type="file" id = "poster" name="poster" accept="image/*" />
						 </div>
					  
						<button type="submit" name= "submit" class="btn btn-primary">Submit</button>
						
					</form>
	  
				</div><!--Ende div col-8 -->
				
				<div class="col-sm-2"></div>
				
			</div> <!--Ende div class row -->
		</div><!--Ende div container -->
	</div><!--Ende div wrap -->
	
    <footer class="footer"><?php include('view/partials/footer.php'); ?></footer>
    <?php include('view/partials/scripts.php'); ?>
   
  </body>
</html>	