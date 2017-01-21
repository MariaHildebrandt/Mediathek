<?php
include('classes/Books.php');

if(isset($_POST['genre']))
{
	switch($_POST){
		case "fantasy":
			//pdo fetch where genre gleich fanatasy = $ergebnisarray;
		break;
		case "mystery":
			//pdo fetch where genre gleich fanatasy = $ergebnisarray;
		break;
	}
}
elseif(isset($_POST['auhtor']))
{
	//pdo fetch where author gleich url = $ergebnisarray;
}
else{
	//redirect error
}

//zweifach foreach um inhalte zu zeigen die der url entsprechen