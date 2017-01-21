<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include('view/partials/head.php'); ?>
   
  </head>
  <body>
  <?php include('view/partials/nav.php'); ?>
  <?php include('view/partials/wide.php'); ?>
   
	<div  class="container">
	<?php include('view/partials/genres.php'); ?>
	<?php include('view/partials/quotes.php'); ?>
	</div> <!--Ende div container -->
	<?php include('view/middleimage.php'); ?>
	<div  class="container">
	<div id="wrapper">
		<div class= "row" style="padding-top:60px"><!-- row für Bücher-->
			
			<!--
			-- neueste Bücher
			-->
			<div class="col-lg-10 col-lg-offset-1">
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
								<div class="col-lg-3">
									<?php
										$bookPicture = new Picture;
										$bookID = $item['bookID'];
										$pic = $bookPicture->getPicture($bookID);
									 ?>
									 <a href="bookDetails.php?details_id=<?php echo $item['bookID']; ?>">
										<img src="book_images/<?php echo $pic[0]['picture']; ?>" class=" img img-rounded img-hover" width="200px" height="300px" />
									 </a>
								</div> 
								
					<?php 	} //end forech
						} //end if ?>
										
			</div><!--Ende div col-10 -->
		</div><!-- Ende div row Bücher -->
		<div class= "row">
			<div class="col-lg-2 col-lg-offset-5" >
				<button class="button" id="allbooks"><a href="books.php">Alle Bücher anzeigen</a></button>
			</div>
		</div>
			
			<!--
			-- neueste Filme
			-->
		<div class= "row" style="padding-top:40px"><!-- row für Filme-->
			<div class="col-lg-10 col-lg-offset-1">
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
										<img  src="film_poster/<?php echo $pic[0]['poster']; ?>" class="img img-rounded img-hover" width="200px" height="300px" />
									 </a>
								</div> 
								
					<?php 	} //end forech
						} //end if ?>
					
			</div><!-- Ende col-10 -->
		</div><!--Ende div row filme-->
		
		<div class= "row">
			<div class="col-lg-2 col-lg-offset-5">
				<button class="button" id="allfilms"><a href="films.php">Alle Filme anzeigen</a></button>
			</div>
		</div>
	</div><!--Ende wrapper-->
		
			
			
	</div> <!--Ende div container -->
	
	 <?php include('view/partials/bottom.php'); ?>
	 
	<footer><?php include('view/partials/footer.php'); ?></footer>
   
	<?php include('view/partials/scripts.php'); ?>
   
  </body>
</html>