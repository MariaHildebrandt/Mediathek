<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'classes/Book.php';
	require_once 'classes/Picture.php';
	
	
	if(isset($_POST['submit']))
	{
		$bookAuthor = $_POST['author'];
		$bookTitle = $_POST['title'];
		$bookCategory = $_POST['category']; 
		$bookDesc = $_POST['description'];
		
		$imgFile = $_FILES['picture']['name'];
		$tmp_dir = $_FILES['picture']['tmp_name'];
		$imgSize = $_FILES['picture']['size'];
		
		if(empty($bookAuthor)){
			$errMSG = "Bitte tragen Sie den Namen des Autors ein.";
		}
		elseif(empty($bookTitle)){
			$errMSG = "Bitte tragen sie den Buchtitel ein.";
		}
		elseif(empty($imgFile)){v
			$errMSG = "Bitte wählen sie ein Bild.";
		}
		else 
		{
			$upload_dir = 'book_images/'; 
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); //Dateiformat
		
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
			$pic = $imgFile; 
			
			/*
			* Prüft Format
			* und Größe der Datei
			*/
			
			if(in_array($imgExt, $valid_extensions)){			
				// Datei größe <'5MB'
				if(($pictureSize < 5000000))
				{
					move_uploaded_file($tmp_dir,$upload_dir.$pic);
				}
				else{
					$errMSG = "Datei darf nicht gr&ouml;&szlig;er als 5MB sein.";
				}
			}
			else{
				$errMSG = "Nur JPG, JPEG, PNG & GIF.";		
			}
		}
		 
		/* Wenn alles geprüft wurde,
		* können die neuen Information übertragen werden
		*/
		 
		if(!isset($errMSG))
		{
			$newBook = new Book;
			$newBook->insert($bookAuthor,$bookTitle,$bookCategory,$bookDesc);
			
			$bookID=$newBook->getNewestID();
			$entry = $bookID[0]['bookID'];
			
			$newPicture = new Picture;
			$newPicture->insert($pic,$entry);
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
						<h1 class="h2">Alle Bücher / Neues Buch hinzufügen  
							<a class="btn btn-default" href="books.php"> 
								<span class="glyphicon glyphicon-eye-open"></span> &nbsp; Alle Bücher anzeigen 
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
					<form method="post" enctype="multipart/form-data" class="form-horizontal"  id="newBook">
					
					     <div class="form-group">
							 <label for="title">Titel</label>
							 <input type="text" class="form-control" id="title" name ="title" placeholder="">
					     </div>
					  
					     <div class="form-group">
							 <label for="author">Autor</label>
							 <input type="text" class="form-control" id="author" name = "author" placeholder="">
					     </div>
					  
					     <div class="form-group">
							 <label for="category">Kategorie</label>
							 <select class="form-control" id="category" name = "category">
								 <option value = "roman">Roman</option>
								 <option value = "sachbuch">Sachbuch</option>
								 <option value = "magazin">Magazin</option>
								 <option value = "none">keine Kategorie</option>
							 </select>
					     </div>
					  
					     <div class="form-group">
							<label for="description">Beschreibung</label>
							<textarea class="form-control" id="description" name = "description" placeholder="darf leer bleiben" rows="3"></textarea>
					     </div>
					  
					     <div class="form-group">
							<label for="picture"  class="control-label">Bild hinzufügen</label>
							<input class="input-group" type="file" id = "picture" name="picture" accept="image/*" />
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