<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpjmd_m extends MY_Model
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

    public function get_data($id=null)
	{
    $query = $this->db->query("SELECT a.periode_id, a.visi, b.misi, c.tujuan, d.sasaran, e.indikator, e.id as indikator_id FROM sakip_visi a LEFT JOIN sakip_misi b ON a.id = b.visi_id AND b.deleted_at is NULL LEFT JOIN sakip_tujuan c on a.id = c.visi_id AND b.id = c.misi_id AND c.deleted_at is NULL LEFT JOIN sakip_sasaran d on c.id = d.tujuan_id AND d.deleted_at is NULL LEFT JOIN sakip_indikator e ON d.id = e.sasaran_id and e.deleted_at IS NULL WHERE a.deleted_at IS NULL AND a.periode_id = {$id}");
		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return FALSE;
		}
    }
}