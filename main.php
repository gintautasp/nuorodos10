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
	
	include DIR_BENDRAM . 'duomenu_baze.class.php';

	$db = new DuomenuBaze ( 'nuorodos10' );	
	
	include DIR_BENDRAM . 'controller.class.php';

	include DIR_BENDRAM . 'model_db.class.php';
	include DIR_BENDRAM . 'model_db_irasas.class.php';	
	include DIR_BENDRAM . 'model_db_sarasas.class.php';
	
	include 'zymos.class.php';
	include 'nuoroda.class.php';
	include 'nuorodos.class.php';	
	include 'nuorodu_sistema.class.php';
	
	$app = new NuoroduSistema();
	
	$app -> tikrintiUzklausuDuomenis();
	
	if ( $app -> arAtsiustaNaujaNuoroda() ) {
	
		$app -> issaugotiNaujaNuoroda();
	}
	
	if ( $app -> arAtsiustiPakeistiNuorodosDuomenys() ) {
	
		$app -> issaugotiPakeistaNuoroda();
	}	
	
	if ( $app -> arSalintiNuoroda() ) {										// zymu_saugykla ar nurodyta šalinti žymą
		
		$app -> salintiNuoroda();											// zymu_saugykla  pašalink nurodyta žyma
	}	
	
	$app -> gautiDuomenis();

	include 'main.html.php';