<?php 
//bookdetails

	include 'classes/Film.php';
	include 'classes/Poster.php';

	if(isset($_GET['details_id']))
	{
		$filmID = $_GET['details_id'];

		$film = new Film;
		$filmValues = $film->getValues($filmID);
		
		$poster = new Poster;
		$filmPoster = $poster->getPoster($filmID);
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
						<span class="glyphicon glyphicon-eye-open"></span> &nbsp; Alle Filme anzeigen 
					</a>
					<hr>
				<!--Tabelle für Buchdetails--->
				
					<table class="table table-inverse">
					    <thead>
							<tr>
							  <th>Filmtitel</th>
							  <th><?php echo $filmValues[0]['filmTitle'];?></th>
					 		</tr>
					    </thead>
					    <tbody>
							<tr>
							  <th scope="row">Direktor</th>
							  <td><?php echo $filmValues[0]['filmDirector'];?> </td>
							</tr>
							<tr>
							  <th scope="row">Genre</th>
							  <td><?php echo ucfirst($filmValues[0]['filmGenre']);?> </td>
							</tr>
							<tr>
							  <th scope="row">Beschreibung</th>
							  <td><?php if(!empty($filmValues[0]['filmDesc']))
										{
											echo $filmValues[0]['filmDesc'];
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
						<a class="btn btn-info" href="updateFilm.php?edit_id=<?php echo $filmValues[0]['filmID']; ?>" title="click for edit">
							<span class="glyphicon glyphicon-edit"></span> Edit
						</a> 
						<a class="btn btn-danger" href="deleteFilm.php?delete_id=<?php echo $filmValues[0]['filmID']; ?>" title="click for delete" onclick="return confirm('Sind Sie sich sicher, dass sie den Film löschen wollen?')">
							<span class="glyphicon glyphicon-remove-circle"></span> Delete
						</a>
					</span>
					 
					 <!--Ende und Delete-->
					
				</div> <!-- Ende Col-8-->
				<div class="col-sm-4">
					<img src="film_poster/<?php echo $filmPoster[0]['poster'];?>" class="img-rounded" width="250px" height="350px" />
				</div>
			</div><!-- ende div row --> 
		</div><!-- ende div container --> 
	</div><!-- ende div wrap --> 
	
    <footer class="footer"><?php include('view/partials/footer.php'); ?></footer>
	<?php include('view/partials/scripts.php'); ?>
   
  </body>
</html>	