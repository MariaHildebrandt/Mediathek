<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'classes/Book.php';
	require_once 'classes/Picture.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$bookID = $_GET['edit_id'];
		$showBook = new Book;
		$bookValues= $showBook->getValues($bookID); //Entnimmt DB-Einträge aus Tabelle tbl_books
		
		$picture = new Picture;
		$pictureForBook = $picture->getPicture($bookID);  //Entnimmt DB-Eintrage aus Tabelle tbl_poictures für bookID
		
	}
	else
	{
		header("Location: index.php");
	}
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$bookAuthor = $_POST['author'];
		$bookTitle = $_POST['title'];
		$bookCategory = $_POST['category']; 
		$bookDesc = $_POST['description'];
			
		$imgFile = $_FILES['picture']['name'];
		$tmp_dir = $_FILES['picture']['tmp_name'];
		$imgSize = $_FILES['picture']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'book_images/';
			
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); //Dateiformat
			
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
			
			$userpic = $imgFile;
			
			/*
			* Prüft Format
			* und Größe der Datei
			*/
			
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$pictureForBook[0]['picture']); 
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
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
			$userpic  = $pictureForBook[0]['picture']; //wenn kein neues bild hochgeladen -> vorhandenes ünernehmen
		}	
						
		/* Wenn alles geprüft wurde,
		* können die neuen Information übertragen werden
		*/
		
		if(!isset($errMSG))
		{  
			$updateBook = new Book;
			$updateBook->update($bookID,$bookAuthor,$bookTitle,$bookCategory,$bookDesc);
			
			$updatePicture = new Picture;
			$updatePicture->update($userpic,$bookID); 
			header ('Location: books.php');
		
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
						<h1 class="h2">Buch editieren  
							<a class="btn btn-default" href="books.php"> 
								<span class="glyphicon glyphicon-eye-open"></span> &nbsp; Alle Bücher anzeigen 
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
							<input type="text" class="form-control" id="title" name ="title" value="<?php echo $bookValues[0]['bookTitle']; ?>" />
						 </div>
						  
						<div class="form-group">
							<label for="author">Autor</label>
							<input type="text" class="form-control" id="author" name = "author" value="<?php echo $bookValues[0]['bookAuthor']; ?>" />
						</div>
						  
						 <div class="form-group">
							<label for="category">Kategorie</label>
							<select class="form-control" id="category" name = "category" value="<?php echo $bookValues[0]['bookCategory']; ?>" />>
								<option value = "roman">Roman</option>
								<option value = "sachbuch">Sachbuch</option>
								<option value = "magazin">Magazin</option>
								<option value = "none">keine Kategorie</option>
							</select>
						 </div>
						  
						 <div class="form-group">
							<label for="description">Beschreibung</label>
							<textarea class="form-control" id="description" name = "description" placeholder="darf leer bleiben" rows="3" value="<?php echo $bookValues[0]['bookDesc']; ?>" ></textarea>
						 </div>
						  
						 <div class="form-group">
							<label for="picture"  class="control-label">Bild hinzufügen</label>
								<p><img src="book_images/<?php echo $pictureForBook[0]['picture']; ?>" height="350" width="250" /></p>
							 <input class="input-group" type="file" id = "picture" name="picture" accept="image/*" />
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