<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran_m extends MY_Model
{
	public $table = 'pohon'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array('b.periode','a.sasaran','a.eselon_id',null); //set kolom field database pada datatable secara berurutan
    public $column_search = array('b.periode','a.sasaran','a.eselon_id'); //set kolom field database pada datatable untuk pencarian
    public $order = array('eselon_id' => 'ASC'); //order baku 
	
	public function __construct()
	{
		$this->timestamps = TRUE;
		$this->soft_deletes = TRUE;
		parent::__construct();
	}
	
	public function get_new()
    {
        $record = new stdClass();
        $record->id = '';
		$record->periode_id = '';
		$record->eselon_id = '';
		$record->sasaran = '';
		return $record;
    }
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
        $this->db->select('a.*, b.periode');
		$this->db->from('pohon a');
		$this->db->join('ref_periode b','a.periode_id = b.id','LEFT');
		//$this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    //urusan lawan ambil data
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->where('a.satker_id', $this->session->userdata('satker'));
        $this->db->where('a.deleted_at', NULL);
		$this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	
	function get_id($id=null)
    {
        $this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get($this->table);
		if($query->num_rows() > 0){
			return $query->row();	
		}else{
			//show_404();
			return FALSE;
		}
        
    }
	
	public function get_periode()
	{
        $query = $this->db->where('deleted_at',NULL)->order_by('awal', 'ASC')->get('ref_periode');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Periode Waktu';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->periode;
		}
        }else{
            $dropdown[''] = 'Belum Ada Periode Waktu'; 
        }
		return $dropdown;
    }
    
    public function get_eselon()
	{
        $query = $this->db->where('deleted_at',NULL)->where_in('kode',array(11,12,21,31,41,99))->order_by('kode', 'ASC')->get('ref_eselon');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Tingkat Jabatan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->jabatan;
		}
        }else{
            $dropdown[''] = 'Belum Ada Referensi Tingkat Jabatan'; 
        }
		return $dropdown;
	}
	
	public function get_parent($periode=null, $eselon=null)
	{
        $query = $this->db->where('periode_id',$periode)->where('eselon_id <',$eselon)->where('deleted_at',NULL)->where('satker_id',$this->session->userdata('satker'))->order_by('id', 'ASC')->get('pohon');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Sasaran Kinerja Induk';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->sasaran;
		}
        }else{
            $dropdown[''] = 'Belum Ada Sasaran Kinerja Induk Tersedia'; 
        }
		return $dropdown;
	}

}