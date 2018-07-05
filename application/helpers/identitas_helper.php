<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//data pribadi
if (! function_exists('nama'))
{
	function nama($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$query = $CI->db->get('identitas');
        if($query->num_rows() > 0){
			$row = $query->row();
			return gelar($row->gelar1, $row->nama, $row->gelar2);
		}else{
            return FALSE;
        }
	}
}

if (! function_exists('gelar'))
{
	function gelar($gelar1, $nama, $gelar2)
	{
		$var1 = isset($gelar1) && $gelar1 != '' ? $gelar1.'. ' : '';
		$var2 = isset($nama) ? $nama : '';
		$var3 = isset($gelar2) && $gelar2 != '' ? ', '.$gelar2 : '';
		return $var1.$var2.$var3;
	}
}

if (! function_exists('biodata'))
{
	function biodata($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$query = $CI->db->get('identitas');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//cari kedudukan
if (! function_exists('kedudukan'))
{
	function kedudukan($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_kedudukan');
        if($query->num_rows() > 0){
			return $query->row()->kedudukan;
		}else{
            return '-';
        }
	}
}

//cari status
if (! function_exists('status'))
{
	function status($id=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $id);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_status');
        if($query->num_rows() > 0){
			return $query->row()->status;
		}else{
            return '-';
        }
	}
}

//cari jenis
if (! function_exists('jenis'))
{
	function jenis($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_jenis');
        if($query->num_rows() > 0){
			return $query->row()->jenis;
		}else{
            return '-';
        }
	}
}

//data cpns
if (! function_exists('cpns'))
{
	function cpns($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('cpns');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//data pns
if (! function_exists('pns'))
{
	function pns($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$query = $CI->db->get('pns');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//list pangkat
if (! function_exists('pangkat'))
{
	function pangkat($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->order_by('tmt', 'DESC');
		$query = $CI->db->get('pangkat');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

//cari golongan
if (! function_exists('gol'))
{
	function gol($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_pangkat');
        if($query->num_rows() > 0){
			return $query->row()->golongan;
		}else{
            return '-';
        }
	}
}

//cari pangkat
if (! function_exists('pkt'))
{
	function pkt($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_pangkat');
        if($query->num_rows() > 0){
			return $query->row()->pangkat;
		}else{
            return '-';
        }
	}
}

//cari pangkat
if (! function_exists('eselon'))
{
	function eselon($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_eselon');
        if($query->num_rows() > 0){
			return $query->row()->jabatan;
		}else{
            return '-';
        }
	}
}

//list jabatan
if (! function_exists('jabatan'))
{
	function jabatan($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->order_by('tmt', 'DESC');
		$query = $CI->db->get('jabatan');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

//list pendidikan
if (! function_exists('pendidikan'))
{
	function pendidikan($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->order_by('ktpu', 'DESC');
		$CI->db->order_by('tahun', 'DESC');
		$query = $CI->db->get('pendidikan');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

//cari ktpu
if (! function_exists('ktpu'))
{
	function ktpu($ktpu=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $ktpu);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_ktpu');
        if($query->num_rows() > 0){
			return $query->row()->ktpu;
		}else{
            return '-';
        }
	}
}

//list diklat
if (! function_exists('diklat'))
{
	function diklat($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->order_by('jenis', 'ASC');
		$CI->db->order_by('akhir', 'DESC');
		$query = $CI->db->get('diklat');
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return FALSE;
        }
	}
}

//list ktpu_akhir (pendidikan akhir)
if (! function_exists('ktpu_akhir'))
{
	function ktpu_akhir($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->limit(1);
		$query = $CI->db->get('pendidikan_akhir');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//list pangkat_akhir
if (! function_exists('pangkat_akhir'))
{
	function pangkat_akhir($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->limit(1);
		$query = $CI->db->get('pangkat_akhir');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return FALSE;
        }
	}
}

//list jabatan_akhir
if (! function_exists('jabatan_akhir'))
{
	function jabatan_akhir($nip=null)
	{
		$CI =& get_instance();
		$CI->db->where('nip', $nip);
		$CI->db->where('deleted_at', null);
		$CI->db->limit(1);
		$query = $CI->db->get('jabatan_akhir');
        if($query->num_rows() > 0){
			return $query->row();
		}else{
            return '-';
        }
	}
}

//analisa jabatan
if (! function_exists('analisa'))
{
	function analisa($nip=null, $eselon=null, $kode=null, $parent=null)
	{
		if($eselon == '99' || $eselon == ''){
			$CI =& get_instance();
			$CI->db->where('eselon', '41');
			//$CI->db->or_where('eselon', '42');
			$CI->db->where('satker_id', $kode);
			$query = $CI->db->get('jabatan_akhir')->row('nip');
			if($query){
				$bos = $query;
			}else{
				$bos = null;
			}
			
			$pimpinan = pangkat_akhir($bos) ? pangkat_akhir($bos)->golongan : 0;
			$pangkat = pangkat_akhir($nip) ? pangkat_akhir($nip)->golongan : 0;
			if($pimpinan != 0){
				if($pangkat > $pimpinan){
					return 'Pangkat Lebih Tinggi Dari Pengawas';
				}else{
					return '-';
				}
			}else{
				return '-';
			}
		}else{
			return '-';
		}
	}
}

//analisa jabatan
if (! function_exists('indikator'))
{
	function indikator($kode=null)
	{
		if($kode){
			$CI =& get_instance();
			$CI->db->where('indikator_id', $kode);
			$query = $CI->db->get('indikator_detail');
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
	}
}

if (! function_exists('makro'))
{
	function makro($kode=null)
	{
		if($kode){
			$CI =& get_instance();
			$CI->db->where('makro_id', $kode);
			$query = $CI->db->get('makro_detail');
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
	}
}

if (! function_exists('pohon_detail'))
{
	function pohon_detail($kode=null)
	{
		if($kode){
			$CI =& get_instance();
			$CI->db->where('indikator_id', $kode);
			$query = $CI->db->get('pohon_detail');
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
	}
}

if (! function_exists('pohon_deskripsi'))
{
	function pohon_deskripsi($kode=null)
	{
		if($kode){
			$CI =& get_instance();
			$CI->db->where('indikator_id', $kode);
			$query = $CI->db->get('pohon_deskripsi');
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
	}
}

if (! function_exists('target'))
{
	function target($tahun=null, $id=null)
	{
		if($tahun && $id){
			$CI =& get_instance();
			$CI->db->where('indikator_id', $id);
			$CI->db->where('tahun', $tahun);
			$query = $CI->db->get('indikator_detail');
			if($query->num_rows() > 0){
				return $query->row()->target;
			}else{
				return FALSE;
			}
		}
	}
}

if (! function_exists('pohon_realisasi'))
{
	function pohon_realisasi($kode=null, $tahun=null)
	{
		if($kode){
			$CI =& get_instance();
			$CI->db->where('indikator_id', $kode);
			$CI->db->where('tahun', $tahun);
			$query = $CI->db->get('pohon_realisasi');
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
	}
}

if (! function_exists('realisasi'))
{
	function realisasi($kode=null, $tahun=null)
	{
		if($kode){
			$CI =& get_instance();
			$CI->db->where('id', $kode);
			$CI->db->where('tahun', $tahun);
			$query = $CI->db->get('pohon_realisasi');
			if($query->num_rows() > 0){
				return $query->row();
			}else{
				return FALSE;
			}
		}
	}
}

if (! function_exists('tanggung_jawab'))
{
	function tanggung_jawab($indikator=null, $deskripsi=null)
	{
		if($indikator && $deskripsi){
			$CI =& get_instance();
			$CI->db->where('indikator_id', $indikator);
			$CI->db->where('deskripsi_id', $deskripsi);
			$query = $CI->db->get('pohon_jabatan');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}

if (! function_exists('proker_jabatan'))
{
	function proker_jabatan($proker=null)
	{
		if($proker){
			$CI =& get_instance();
			$CI->db->where('proker_id', $proker);
			$query = $CI->db->get('proker_jabatan');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}

if (! function_exists('posisi'))
{
	function posisi($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('kode', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_jabatan');
		if($query->num_rows() > 0){
			return $query->row()->jabatan;
		}else{
			return FALSE;
		}
	}
}

if (! function_exists('periode'))
{
	function periode($kode=null)
	{
		$CI =& get_instance();
		$CI->db->where('id', $kode);
		$CI->db->where('deleted_at', null);
		$query = $CI->db->get('ref_periode');
		if($query->num_rows() > 0){
			return $query->row()->periode;
		}else{
			return FALSE;
		}
	}
}

if (! function_exists('pohon_indikator'))
{
	function pohon_indikator($kode=null)
	{
		if($kode){
			$result = array();
			$CI =& get_instance();
			$CI->db->where('sasaran_id', $kode);
			$CI->db->where('deleted_at', null);
			$query = $CI->db->get('pohon_indikator');
			if($query->num_rows() > 0){
				//$data = $query->result();
				// foreach($data as $x){
				// 	$result = ucwords(strtolower($x->indikator)).';';
				// 	//$resutl .= ';';
				// 	//$result = 'hallo';
				// }
				//return $result;
				return $query->result();
			}else{
				return FALSE;
			}
		}
	}
}