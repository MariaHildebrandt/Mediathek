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
			<div class="col-sm-12">
			
				<div class="page-header">
					<h2 class="h2">Alle Bücher / 
						<a class="btn btn-default" href="insertBook.php"> 
							<span class="glyphicon glyphicon-plus"></span> &nbsp; Neues Buch hinzufügen 
						</a>
					</h2> 
				</div>
    
				<br />

				<div class="row">
					<?php
					 
					require_once'classes/Book.php';
					require_once'classes/Picture.php';
					
					$books = new Book;
					$allBooks = $books->show('all'); 
					
					if(sizeof($allBooks)!=0)
					{
						foreach ($allBooks as $book => $item){
						?>
						<div class="col-xs-3">
						
								<p class="page-header">
									<?php echo $item['bookAuthor']."</br>".$item['bookTitle'] ."</p>"; ?>
									
									<?php
											$bookPicture = new Picture;
											$bookID = $item['bookID'];
											$pic = $bookPicture->getPicture($bookID);
									 ?>
									 <a href="bookDetails.php?details_id=<?php echo $item['bookID']; ?>">
										<img src="book_images/<?php echo $pic[0]['picture']; ?>" class="img-rounded" width="250px" height="350px" />
									 </a>
								</p>
								
								<p class="page-header">
									<span>
										<a class="btn btn-info" href="updateBook.php?edit_id=<?php echo $item['bookID']; ?>" title="click for edit">
											<span class="glyphicon glyphicon-edit"></span> Edit
										</a> 
										<a class="btn btn-danger" href="deleteBook.php?delete_id=<?php echo $item['bookID']; ?>" title="click for delete" onclick="Sind Sie sich sicher, dass sie das Buch löschen wollen?')">
											<span class="glyphicon glyphicon-remove-circle"></span> Delete
										</a>
									</span>
								</p>
						</div> 
						
					<?php } //Ende forech
					} //Ende if ?>

				</div><!--schliesst div row-->

			</div> <!--Ende col-12-->
		</div><!--Ende Container-->
	</div><!--Ende Wrap -->
	
	<footer class="footer"><?php include('view/partials/footer.php'); ?></footer>
   
	<?php include('view/partials/scripts.php'); ?>
   
  </body>
</html>	