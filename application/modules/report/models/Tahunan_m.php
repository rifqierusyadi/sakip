<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunan_m extends MY_Model
{
	public $table = 'ref_periode'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array('id','periode',null); //set kolom field database pada datatable secara berurutan
    public $column_search = array('periode'); //set kolom field database pada datatable untuk pencarian
    public $order = array('id' => 'asc'); //order baku 
	
	public function __construct()
	{
		$this->timestamps = TRUE;
		$this->soft_deletes = FALSE;
		parent::__construct();
	}

	public function get_tahun($periode=null)
	{
		$awal = null;
		$akhir = null;
		$query = $this->db->where('deleted_at',NULL)->where('id',$periode)->get('ref_periode');
        if($query->num_rows() > 0){
			$dropdown[''] = 'Pilih Tahun';
			$awal = $query->row()->awal;
			$akhir = $query->row()->akhir;
			for($tahun = $awal; $tahun <= $akhir; $tahun++){
				$dropdown[$tahun] =$tahun;
			}
		}else{
			$dropdown[] = 'Belum Ada Tahun Tersedia'; 
		}
		return $dropdown;
	}
	
	public function get_periode()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('id', 'ASC')->get('ref_periode');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Periode';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->periode;
		}
        }else{
            $dropdown[] = 'Belum Ada Periode Tersedia'; 
        }
		return $dropdown;
	}

	public function get_satker()
	{
        $query = $this->db->where('deleted_at',NULL)->where('parent_id',NULL)->or_where('upt',1)->order_by('id', 'ASC')->get('ref_satker');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Satuan Kerja';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->satker;
		}
        }else{
            $dropdown[] = 'Belum Ada Satuan Kerja Tersedia'; 
        }
		return $dropdown;
	}

	public function get_jabatan($satker=null)
	{
        $query = $this->db->like('path',$satker)->get('view_jabatan');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Penanggung Jawab';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->jabatan;
		}
        }else{
            $dropdown[] = 'Belum Ada Penanggung Jawab Tersedia'; 
        }
		return $dropdown;
	}

	public function get_data($periode=null, $tahun=null,$satker=null,$jabatan=null, $triwulan = null)
	{
		//$query = $this->db->query("SELECT a.id, a.deskripsi, a.sumber, b.indikator, b.id as indikator_id, c.sasaran FROM sakip_pohon_deskripsi a LEFT JOIN sakip_pohon_indikator b ON a.indikator_id = b.id AND b.deleted_at is NULL LEFT JOIN sakip_pohon c ON c.id = b.sasaran_id AND c.deleted_at is NULL WHERE b.periode_id = '{$periode}' AND b.satker_id = '{$satker}' ORDER BY c.eselon_id ASC");
		$query = $this->db->query("SELECT a.id, a.indikator_id, a.deskripsi, a.sumber, b.indikator, b.id as indikator_id, c.sasaran, e.target, e.tw1, e.tw2, e.tw3, e.tw4, b.satuan_id FROM sakip_pohon_deskripsi a LEFT JOIN sakip_pohon_indikator b ON a.indikator_id = b.id AND b.deleted_at is NULL LEFT JOIN sakip_pohon_detail e ON a.indikator_id = e.indikator_id AND e.deleted_at is NULL LEFT JOIN sakip_pohon c ON c.id = b.sasaran_id AND c.deleted_at is NULL LEFT JOIN sakip_pohon_jabatan d ON a.indikator_id = d.indikator_id AND d.deleted_at is NULL WHERE b.periode_id = '{$periode}' AND b.satker_id = '{$satker}' AND d.jabatan = '{$jabatan}' AND e.tahun = '{$tahun}' AND a.deleted_at is NULL GROUP BY a.indikator_id ORDER BY `a`.`id` ASC");
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return FALSE;
		}
    }
}