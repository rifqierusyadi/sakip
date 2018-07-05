<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pohon_m extends MY_Model
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
	
	public function get_data($id=null, $satker=null)
    {
        $this->db->select('a.*, b.sasaran_id, b.indikator');
        $this->db->from('pohon a');
        $this->db->join('pohon_indikator b', 'a.id = b.sasaran_id','LEFT');
        $this->db->where('a.deleted_at', NULL);
		$this->db->where('a.periode_id', $id);
		$this->db->where('a.satker_id', $satker);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;
		}
        
    }
}