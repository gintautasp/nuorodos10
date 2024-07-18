<?php
	/*
		patikrinti užklausos duomenis
		
		jei atsiusta nauja nuoroda,
			tai išsaugoti nauja nuoroda

		jei atsiusti pakeisti nuorodos duomenys
			tai išsaugoti pakeista nuoroda 
			
		pasiimk nuorodas pagal pasirinktus kriterijus
	*/
	define ( 'DIR_BENDRAM', realpath ( __DIR__ . '/../bendram/' ) . '/' );
	
	include DIR_BENDRAM . 'controller.class.php';
	include 'nuorodu_sistema.class.php';
	
	$app = new NuoroduSistema();
	
	$app -> tikrintiUzklausuDuomenis();
	
	if ( $app -> arAtsiustaNaujaNuoroda() ) {
	
		$app -> issaugotiNuoroda();
	}
	
	if ( $app -> arAtsiustiPakeistiNuorodosDuomenys() ) {
	
		$app -> issaugotiNuoroda();
	}	
	
	$app -> gautiDuomenis();

	include 'main.html.php';