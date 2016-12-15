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
					<h2 class="h2">Alle Filme / 
						<a class="btn btn-default" href="insertFilm.php"> 
							<span class="glyphicon glyphicon-plus"></span> &nbsp; Neuen Film hinzufügen 
						</a>
					</h2> 
				</div> 
				<br />

				<div class="row">
					<?php
					 
					require_once'classes/Film.php';
					require_once'classes/Poster.php';
					
					$films = new Film;
					$allFilms= $films->show('all'); 
					
					if(sizeof($allFilms)!=0)
					{
						foreach ($allFilms as $film => $item){
						?>
							<div class="col-xs-3">
							
									<p class="page-header">
										<?php echo $item['filmDirector']."</br>".$item['filmTitle'] ."</p>"; ?>
										
										<?php
												$filmPoster = new Poster;
												$filmID = $item['filmID'];
												$pic = $filmPoster->getPoster($filmID);
										 ?>
										 <a href="filmDetails.php?details_id=<?php echo $item['filmID']; ?>">
											<img src="film_poster/<?php echo $pic[0]['poster']; ?>" class="img-rounded" width="250px" height="350px" />
										 </a>
									</p> 
									
									<p class="page-header">
										<span>
											<a class="btn btn-info" href="updateFilm.php?edit_id=<?php echo $item['filmID']; ?>" title="click for edit">
												<span class="glyphicon glyphicon-edit"></span> Edit
											</a> 
											<a class="btn btn-danger" href="deleteFilm.php?delete_id=<?php echo $item['filmID']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')">
												<span class="glyphicon glyphicon-remove-circle"></span> Delete
											</a>
										</span>
									</p>
							</div> 
						
					<?php } //Ende Foreach
					} //Ende if ?>

				</div><!--schliesst div row-->

			</div> <!--Ende col-12-->
		</div><!--Ende Container-->
	</div><!--Ende Wrap -->
	
	<footer class="footer"><?php include('view/partials/footer.php'); ?></footer>
   
	<?php include('view/partials/scripts.php'); ?>
   
  </body>
</html>	