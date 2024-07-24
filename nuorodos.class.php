<?php

	class Nuorodos extends ModelDbSarasas {
	
		public 
			$pasirinkta_zyma
			, $paieskos_fraze
			, $paieskos_kriterijai = '1';
	
		function __construct( $pasirinkta_zyma = '', $paieskos_fraze = '' ) {
		
			$this -> pasirinkta_zyma = $pasirinkta_zyma;
			$this -> paieskos_fraze = trim ( $paieskos_fraze );			
			parent::__construct();
		}
		
		public function paieskosKriterijai() {
		
			if ( $this -> pasirinkta_zyma != '' ) {
			
				$this -> paieskos_kriterijai .=
						"
					AND `nuorodos`.`zymos` LIKE( '%" . $this -> pasirinkta_zyma . "%')
						";
			}
			if ( $this -> paieskos_fraze != '' ) {
			
				$this -> paieskos_kriterijai .=
						"
					AND ( 
							`nuorodos`.`zymos` LIKE( '%" . $this -> paieskos_fraze . "%')
						OR
							`nuorodos`.`pav` LIKE( '%" . $this -> paieskos_fraze . "%')
						OR
							`nuorodos`.`url` LIKE( '%" . $this -> paieskos_fraze . "%')							
					)
						";			
			}
		}
	
		public function gautiSarasaIsDuomenuBazes() {
		
			$this -> paieskosKriterijai();
		
			$gw_gauti_sarasa =
					"
				SELECT 
					`id`, `url`, `pav`, `data`
				FROM 
					`nuorodos`
				WHERE
					" . $this -> paieskos_kriterijai . "
					";
			/*
			print_r( $_GET );
			echo $this -> paieskos_kriterijai . ' --- ' . $this -> pasirinkta_zyma;
			echo $gw_gauti_sarasa;
			exit;
			*/
			$rs_list = $this -> db -> uzklausa ( $gw_gauti_sarasa );
			
			while ( $row = $rs_list -> fetch_assoc() ) {
					
				$this -> sarasas[] = $row;
			}
		}	
	}