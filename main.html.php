<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuorodų projektas</title>
	<style>
		body {
			margin: 0;
		}
		aside {
			width: calc(25% - 20px);
			height: 2000px;
			float: left;
			background-color: rgb(239,228,176);
			border-right: 3px solid black;
			padding: 20px 0 0 20px;
		}
		#paieska {
			height: 90px;
			width: 75%;
			margin-left: 25%;
			background-color: rgb(239,228,176);
			border-bottom: 3px solid black;
			padding-top: 30px; 
		}
		#pagrindinis{
			display: inline-block;
			width: 500px;
			margin-left: 200px;
		}
		#prideti {
			background-color: blue;
		}
		.veiksmai {
			width: 25px;
			height: 30px;
			padding: 3px 2px;
			margin-left: 12px; 
		}
		main {
			margin-left: 25%;
			width: 75%;			
		}
		#nuorodu_sarasas {
			list-style-type: none;
			margin-left: 50px;
			margin-top: 30px;
		}
		#nuorodu_sarasas  li{
			margin-top: 7px;
		}
		.redaguoti {
			margin-right: 12px;
		}
		.privaloma {
			color: red;
		}
		#uzdaryti, #saugoti {
			float: right;
		}
		#saugoti {
			width: 100px;
		}
		#nuorodos_redagavimas {
			width: 600px;
		}
		#nuorodos_redagavimas  label {
			display: block;
		}
		#nuorodos_redagavimas  input[type=text] {
		
			width: 99%;
			margin: 4px 0 15px 0;
		}
	</style>
	<script>
		function atvertiNuorodosDialoga(id_nuorodos) {
		
			nuorodos_redagavimas = document.getElementById ( 'nuorodos_redagavimas' );
		
			nuorodos_redagavimas.showModal();
		}
		
		function uzdarytiNuorodosDialoga() {
			
			nuorodos_redagavimas = document.getElementById ( 'nuorodos_redagavimas' );
		
			nuorodos_redagavimas.close();			
		}
	</script>
</head>
<body>
	<aside>
		<h2>Žymos</h2>
		<a href="?zyma=biuro įrankiai">biuro įrankiai</a> &nbsp; <a href="?zyma=biuro įrankiai">di įrankiai</a>
	</aside>
	<div id="paieska">
		<input type="text" name="pagrindinis" id="pagrindinis"><input type="button" value="+" id="prideti" class="veiksmai" onClick="atvertiNuorodosDialoga(0)"><input type="button" value="&#128269;" id="ieskoti" class="veiksmai">
	</div>
	<main>
<?php
		// parodyti pasiimtas nuorodas
?>
		<ul id="nuorodu_sarasas">
			<li><input type="button" onClick="readguoti()" value="&#9998;" class="veiksmai redaguoti"><a href="https://chatgpt.com/" target="blank">Chat GPT</a></li>
			<li><input type="button" onClick="readguoti()" value="&#9998;" class="veiksmai redaguoti"><a href="https://www.prisijungusi.lt/medziaga/nauji/34/" target="blank">Rekomendacijos kuriant skaidres</a></li>
		</ul>
	</main>
	<dialog id="nuorodos_redagavimas">
			<input type="button" value="X" id="uzdaryti" class="veiksmai" onClick="uzdarytiNuorodosDialoga()">
			<label>Nuoroda <span class="privaloma">*</span></label>
			<input type="text" name="nuoroda" id="nuoroda" required>
			<label>Pavadinimas</label>
			<input type="text" name="pav" id="pav">	
			<label>Žymos </label>
			<input type="text" name="zymos" id="zymos">			
			<input type="button" value="Saugoti" id="saugoti" class="veiksmai">
	</dialog>
</body>
</html>