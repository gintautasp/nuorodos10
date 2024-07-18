<?php

	class NuoroduSistema extends Controller {
	
		public 																				// nuorodų sąrašas
																										// požymiai
			$ar_atsiusta_nauja_nuoroda =false
			, $ar_atsiusti_pakeisti_nuorodos_duomenys = false
				;
				
		function __construct() {
		
		}
	
		public function tikrintiUzklausuDuomenis() {
		
		}
	
		public function arAtsiustaNaujaNuoroda() {
		
			return $this -> ar_atsiusta_nauja_nuoroda;
		}
	
		public function arAtsiustiPakeistiNuorodosDuomenys() {
		
			return $this -> ar_atsiusti_pakeisti_nuorodos_duomenys;
		}
		
		public function issaugotiNuoroda() {
			
		}
		
		public function gautiDuomenis() {
			
		}
	}