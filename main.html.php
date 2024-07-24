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
			background-color: DarkGoldenRod;
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
			background-color: DarkKhaki;
			margin-right: 0;
		}
		.salinti {
			margin-left: 7px;
			margin-right: 7px;
			background-color: DarkSalmon;
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
		a.zyma {
			text-decoration: none;
			color: DarkOliveGreen;
		}
		a.zyma:hover {
			text-decoration: underline;		
		}
		a.pasirinkta_zyma {
			font-weight: bold;
		}
	</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
	<script>
		$ ( document ).ready ( function() {
		
			function atvertiNuorodosDialoga() {
			
				nuorodos_redagavimas = document.getElementById ( 'nuorodos_redagavimas' );
			
				nuorodos_redagavimas.showModal();
			}
			
			function uzdarytiNuorodosDialoga() {
				
				nuorodos_redagavimas = document.getElementById ( 'nuorodos_redagavimas' );
			
				nuorodos_redagavimas.close();			
			}
			
			function duomenys_i_forma(  duomenys ) {
			
				$( '#id_nuorodos' ).val ( duomenys.id );
				$( '#pav' ).val ( duomenys.pav );
				$( '#nuoroda' ).val ( duomenys.url );
				$( '#zymos' ).val ( duomenys.zymos );	
			}

			$( '#uzdaryti' ).click ( function() {
			
				uzdarytiNuorodosDialoga();
			});

			$( '#prideti' ).click( function() {
				
				$( '#id_nuorodos' ).val ( '0' );
				atvertiNuorodosDialoga();
			})
			
			$( '.redaguoti' ).each ( function() {
			
				$( this ).click ( function() {
					
					// pasiimti įrašą iš duomenų bazės pasinaudojant ajax technologija
					id_nuorodos = $( this ).data ( 'id_nuorodos' );

					$.get ( '/nuorodos10/nuorodos-duomenys.php?i='   + id_nuorodos, function( data ) {
						
						// console.log( data);
						duomenys = JSON.parse ( data );
					
						// surašyti reikšmes į įvedimo laukelius kooregavimui
					
						duomenys_i_forma(  duomenys );
						atvertiNuorodosDialoga();
					});
				});
			});
			
			$( '.salinti' ).each ( function() {
			
				$( this ).click ( function() {
			
					id = $( this ).data ( 'id_nuorodos' );

					 if ( confirm( "Ar tikrai norite pašalinti šį įrašą" ) == true ) {
					 
						id_salinamos_nuorodos = document.getElementById ( 'id_salinamos_nuorodos' );
						id_salinamos_nuorodos.value = id;
						salinimo_forma = document.getElementById ( 'salinimo-forma' );
						salinimo_forma.submit();
					} 
				});
			});			
		});
	</script>
</head>
<body>
	<aside>
		<h2>Žymos</h2>
			<a href="/nuorodos10/" class="zyma">visos žymos</a> &nbsp; 
<?php
		foreach ( $app -> zymos -> sarasas as $zyma ) {
?>
			<a href="?zyma=<?= $zyma [ 'zyma' ] ?>" class="zyma<?= (( $zyma [ 'zyma' ] == $app -> pasirinkta_zyma ) ? ' pasirinkta_zyma' : '' )  ?>"><?= $zyma [ 'zyma' ] ?></a> &nbsp; 
<?php
		}
?>
	</aside>
	<div id="paieska">
		<input type="text" name="pagrindinis" id="pagrindinis">
		<input type="button" value="&#128269;" id="ieskoti" class="veiksmai">
		<input type="button" value="&#9997;" id="prideti" class="veiksmai">
	</div>
	<main>
<?php
		// parodyti pasiimtas nuorodas
?>
		<ul id="nuorodu_sarasas">
<?php
		foreach ( $app -> nuorodos -> sarasas as $nuoroda ) {
?>
			<li>
				<input type="button" data-id_nuorodos="<?= $nuoroda [ 'id' ] ?>" value="&#9998;" class="veiksmai redaguoti">
				<input type="button" data-id_nuorodos="<?= $nuoroda [ 'id' ] ?>" value="&cross;" class="veiksmai salinti">
					<a href="<?= $nuoroda [ 'url' ] ?>" target="blank">
						<?= $nuoroda [ 'pav' ] ?>
					</a>
			</li>
<?php
		}
?>
		</ul>
	</main>
	<dialog id="nuorodos_redagavimas">
		<form method="POST" action="">
			<input type="button" value="&cross;" id="uzdaryti" class="veiksmai"><br>
			<label>Nuoroda <span class="privaloma">*</span></label>
			<input type="text" name="nuoroda" id="nuoroda" required>
			<label>Pavadinimas</label>
			<input type="text" name="pav" id="pav">	
			<label>Žymos </label>
			<input type="text" name="zymos" id="zymos">
			<input type="hidden" id="id_nuorodos" name="id_nuorodos" value="0">
			<input type="submit" value="Saugoti" id="saugoti" class="veiksmai" name="veiksmas">
		</form>
	</dialog>
	<form id="salinimo-forma" method="POST" action="">
		<input type="hidden" name="salinti" value="salinti">
		<input type="hidden" id="id_salinamos_nuorodos"  name="id_salinamos_nuorodos"value="0">
	</form>	
</body>
</html>