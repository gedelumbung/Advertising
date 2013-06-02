<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generate_tanggal'))
{
	function generate_tanggal($tgl)
	{
		$get_tanggal = gmdate('d/m/Y-H:i:s',$tgl);
		$get = explode("-",$get_tanggal);
		$get_tanggal = explode("/",$get[0]);
		$get_waktu = $get[1];

		$tanggal = $get_tanggal[0];
		$bulan = getBulan($get_tanggal[1]);
		$tahun = $get_tanggal[2];
		return $tanggal.' '.$bulan.' '.$tahun.' - '.$get_waktu;	
	}
	
	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
}
