<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include('view/partials/head.php'); ?>
   
  </head>
  <body>
  <?php include('view/partials/nav.php'); ?>
   
   
   <div id="wrap">
		<div id="main" class="container clear-top">
			<div class= "row">
			
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
				
					<div class="page-header">
						<h2 class="h2" style="text-align:center; color: #A9A9A9;">Neueste Medien</h2> 
					</div>
					
				</div>
				<div class="col-sm-1"></div>
				
			</div><!--Ende div row -->
			
			<!--
			-- neueste Bücher
			-->
			<div class= "row" style="padding-top:30px">
			
				<div class="col-sm-10">
					<?php
						require_once'classes/Book.php';
						require_once'classes/Picture.php';
		
						$books = new Book;
						$allBooks = $books->show(4); 
			
						if(sizeof($allBooks)!=0)
						{
							foreach ($allBooks as $book => $item)
							{
					?>
								<div class="col-xs-3">
									<?php
										$bookPicture = new Picture;
										$bookID = $item['bookID'];
										$pic = $bookPicture->getPicture($bookID);
									 ?>
									 <a href="bookDetails.php?details_id=<?php echo $item['bookID']; ?>">
										<img src="book_images/<?php echo $pic[0]['picture']; ?>" class="img-rounded" width="200px" height="300px" />
									 </a>
								</div> 
								
					<?php 	} //end forech
						} //end if ?>
					
				</div><!--Ende div col-10 -->
				
				<div class="col-sm-2">
					<a class="btn btn-default" href="books.php"> &nbsp; Alle Bücher </br> anzeigen</a>
				</div>
				
			</div><!-- Ende div row Bücher -->
			
			
			
			<!--
			-- neueste Filme
			-->
			<div class= "row" style="padding-top:30px">
				<div class="col-sm-10">
					<?php
						require_once'classes/Film.php';
						require_once'classes/Poster.php';
		
						$films = new Film;
						$allFilms = $films->show(4); 
			
						if(sizeof($allFilms)!=0)
						{
							foreach ($allFilms as $film => $item)
							{
					?>
								<div class="col-xs-3">
									<?php
										$filmPoster = new Poster;
										$filmID = $item['filmID'];
										$pic = $filmPoster->getPoster($filmID);
									 ?>
									 <a href="filmDetails.php?details_id=<?php echo $item['filmID']; ?>">
										<img src="film_poster/<?php echo $pic[0]['poster']; ?>" class="img-rounded" width="200px" height="300px" />
									 </a>
								</div> 
								
					<?php 	} //end forech
						} //end if ?>
					
				</div><!-- Ende div row Filme -->
				
				<div class="col-sm-2">
					<a class="btn btn-default" href="films.php"> &nbsp; Alle Filme </br> anzeigen</a>
				</div>
			</div>
			
		</div> <!--Ende div container -->
	</div> <!--Ende div row -->
	<footer class="footer"><?php include('view/partials/footer.php'); ?></footer>
   
	<?php include('view/partials/scripts.php'); ?>
   
  </body>
</html>