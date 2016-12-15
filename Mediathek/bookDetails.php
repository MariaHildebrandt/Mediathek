<?php 
	include 'classes/Book.php';
	include 'classes/Picture.php';

	if(isset($_GET['details_id']))
	{
		$bookID = $_GET['details_id'];

		$book = new Book;
		$bookValues = $book->getValues($bookID);
		
		$picture = new Picture;
		$bookPicture = $picture->getPicture($bookID);
	}
	else
	{
		header("Location: index.php");
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
				<div class="col-sm-8">
					<a class="btn btn-default" href="books.php"> 
						<span class="glyphicon glyphicon-eye-open"></span> &nbsp; Alle Bücher anzeigen 
					</a>
					<hr>
					<!--Tabelle für Buchdetails--->
				
					<table class="table table-inverse">
					     <thead>
							<tr>
							  <th>Buchtitel</th>
							  <th><?php echo $bookValues[0]['bookTitle'];?></th>
							</tr>
					     </thead>
					     <tbody>
							<tr>
							     <th scope="row">Autor</th>
							     <td><?php echo $bookValues[0]['bookAuthor'];?> </td>
							</tr>
							<tr>
							     <th scope="row">Kategorie</th>
							     <td><?php echo ucfirst($bookValues[0]['bookCategory']);?> </td>
							</tr>
							<tr>
							     <th scope="row">Beschreibung</th>
							     <td><?php if(!empty($bookValues[0]['bookDesc']))
										{
											echo $bookValues[0]['bookDesc'];
										} 
										else 
										{
											echo "Keine Beschreibung Vorhanden";
										}
									?> 
							</td>
							</tr>
						
					     </tbody>
					</table>
					<!--Ende der Tabelle-->
					
					<!--Edit und Delete-->
					
					<span>
						<a class="btn btn-info" href="updateBook.php?edit_id=<?php echo $bookValues[0]['bookID']; ?>" title="click for edit">
							<span class="glyphicon glyphicon-edit"></span> Edit
						</a> 
						<a class="btn btn-danger" href="deleteBook.php?delete_id=<?php echo $bookValues[0]['bookID']; ?>" title="click for delete" onclick="Sind Sie sich sicher, dass sie das Buch löschen wollen?')">
							<span class="glyphicon glyphicon-remove-circle"></span> Delete
						</a>
					</span>
					
				</div>
				
				<div class="col-sm-4">
					<img src="book_images/<?php echo $bookPicture[0]['picture'];?>" class="img-rounded" width="250px" height="350px" />
				</div>
				
			</div><!-- ende div row --> 
		</div><!-- ende div container --> 
	</div><!-- ende div wrap --> 
	
    <footer class="footer"><?php include('view/partials/footer.php'); ?></footer>
	<?php include('view/partials/scripts.php'); ?>
   
  </body>
</html>	