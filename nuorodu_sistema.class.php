<?php

	class NuoroduSistema extends Controller {
	
		public 																				// nuorodų sąrašas
																										// požymiai
			$ar_atsiusta_nauja_nuoroda =false
			, $ar_atsiusti_pakeisti_nuorodos_duomenys = false
			, $ar_pasalinti_nuoroda = false
			
			, $pasirinkta_zyma = ''
			
			, $zymos
			, $nuorodos
				;
				
		function __construct() {
		
			$this -> zymos = new Zymos();
		}
	
		public function tikrintiUzklausuDuomenis() {
		/*		
			echo 'tikrinam užklausą ..'; 
			print_r ( $_POST );
			exit;		
		*/
			if ( isset ( $_POST [ 'veiksmas' ] ) && (  $_POST [ 'veiksmas' ] == 'Saugoti' ) ) {
			
				if ( intval ( $_POST [ 'id_nuorodos' ]  ) > 0 ) {
				
					$this -> ar_atsiusti_pakeisti_nuorodos_duomenys = true;
	
				} else {
				
					$this -> ar_atsiusta_nauja_nuoroda  = true;			
				}
			}
			
			$this -> ar_pasalinti_nuoroda = isset ( $_POST [ 'salinti' ] ) && ( $_POST [ 'salinti' ] == 'salinti' )   && ( intval ( $_POST [ 'id_salinamos_nuorodos' ] ) > 0 );			
			
			if ( isset ( $_GET [ 'zyma' ] ) && ( trim ( $_GET [ 'zyma' ] ) != '' ) ) {
			
				$this -> pasirinkta_zyma = trim ( $_GET [ 'zyma' ] );
			}
		}
	
		public function arAtsiustaNaujaNuoroda() {
		
			return $this -> ar_atsiusta_nauja_nuoroda;
		}
	
		public function arAtsiustiPakeistiNuorodosDuomenys() {
		
			return $this -> ar_atsiusti_pakeisti_nuorodos_duomenys;
		}
		
		public function issaugotiNaujaNuoroda() {
		
			$nuoroda  = new Nuoroda ( $_POST [ 'pav' ], $_POST [ 'nuoroda' ], $_POST [ 'zymos' ] );
			$nuoroda -> issaugotiNauja();
			
			$this -> zymos -> atnaujintiZymas( $_POST [ 'zymos' ] );
		}
		
		public function issaugotiPakeistaNuoroda() {
		
			$sena_nuoroda = new Nuoroda ( '', '', '', $_POST [ 'id_nuorodos' ] );
			$sena_nuoroda -> pasiimtiDuomenis() ;
			
			$nuoroda =  new Nuoroda ( $_POST [ 'pav' ], $_POST [ 'nuoroda' ],  $_POST [ 'zymos' ], $_POST [ 'id_nuorodos' ] );
			$nuoroda -> pakeistiDuomenis();
			
			$this -> zymos -> mazintiZymuKartojimosiKieki ( $sena_nuoroda -> zymos );
			$this -> zymos -> atnaujintiZymas( $_POST [ 'zymos' ] );			
		}	

		public function arSalintiNuoroda() {
			
			return $this -> ar_pasalinti_nuoroda;
		}
		
		public function salintiNuoroda() {
		
			$salinama_nuoroda = new Nuoroda ( '', '', '', $_POST [ 'id_salinamos_nuorodos' ] );
			$salinama_nuoroda -> pasiimtiDuomenis() ;
			
			$this -> zymos = new Zymos();	
			$this -> zymos -> mazintiZymuKartojimosiKieki ( $salinama_nuoroda -> zymos );			
			
			$salinama_nuoroda -> pasalinti();		
		}
		
		public function gautiDuomenis() {
		
			// echo $this -> pasirinkta_zyma . '***';
			$this -> nuorodos = new Nuorodos( $this -> pasirinkta_zyma );		
		
			$this -> nuorodos -> gautiSarasaIsDuomenuBazes();
			$this -> zymos -> gautiSarasaIsDuomenuBazes();
		}
	}