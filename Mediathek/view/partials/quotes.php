<div><hr></div>
<div class="row quote"  style="padding-top:60px;">
	<div class="col-lg-8 col-lg-offset-2" id="changeText">
		
		<script type="text/javascript">
			var quote1 = ' "Ich sagte zu Kilian, ich käme wieder - und ich möchte kein Lügner sein!" - Running Man';
			var quote2 = ' "Furcht zeigt keine Wirkung, solange es noch Hoffnung gibt." - Die Tribute von Panem';
			var quote3 = ' "Meine Freunde, ihr verbeugt euch vor niemandem."  - Herr der Ringe';
			var text = [quote1, quote2, quote3];
			var counter = 0;
			var elem = document.getElementById("changeText");
			setInterval(change, 5000);
			function change() {
			 elem.innerHTML = text[counter];
				counter++;
				if(counter >= text.length) { counter = 0; }
			}
		</script>
	</div>
</div>
<div><hr></div>