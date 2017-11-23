<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_m extends MY_Model
{
	public $table = 'ref_periode'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array('id','kode','satker',null); //set kolom field database pada datatable secara berurutan
    public $column_search = array('kode','satker'); //set kolom field database pada datatable untuk pencarian
    public $order = array('kode' => 'asc'); //order baku 
	
	public function __construct()
	{
		$this->timestamps = TRUE;
		$this->soft_deletes = FALSE;
		parent::__construct();
	}
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
        // $this->db->select('a.instansi as instan, b.*');
		// $this->db->from('ref_unker b');
		// $this->db->join('ref_instansi a','a.kode = b.instansi','LEFT');
		
		$this->db->from($this->table);
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
        $this->db->where('deleted_at', NULL);
        //$this->db->like('path', $this->session->userdata('satker'));
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_satker($id=null)
	{
		$query = $this->db->get_where('ref_satker',array('id'=>$id));
		if($query->num_rows() > 0)
		{
			return $query->row();
		}else{
			return FALSE;
		}
    }

    public function get_jabatan($id=null)
	{
		$query = $this->db->get_where('ref_jabatan',array('id'=>$id));
		if($query->num_rows() > 0)
		{
			return $query->row();
		}else{
			return FALSE;
		}
    }
	
	public function get_indikator($id=null)
	{
        // $query = $this->db->query("SELECT a.id, a.deskripsi, a.sumber, b.indikator, b.id as indikator_id, c.sasaran FROM sakip_pohon_deskripsi a LEFT JOIN sakip_pohon_indikator b ON a.indikator_id = b.id AND b.deleted_at is NULL LEFT JOIN sakip_pohon c ON c.id = b.sasaran_id AND c.deleted_at is NULL WHERE b.satker_id LIKE '{$id}' ORDER BY c.eselon_id ASC");
		// if($query->num_rows() > 0)
		// {
		// 	return $query->result();
		// }else{
		// 	return FALSE;
        // }
        
        $this->db->select('a.*, b.periode, c.sasaran, c.eselon_id, d.satuan');
		$this->db->from('pohon_indikator a');
		$this->db->join('ref_periode b','a.periode_id = b.id','LEFT');
		$this->db->join('pohon c','a.sasaran_id = c.id','LEFT');
        $this->db->join('ref_satuan d','a.satuan_id = d.id','LEFT');
        $this->db->where('a.satker_id', $this->session->userdata('satker'));
        $this->db->where('a.deleted_at', NULL);
        $query = $this->db->get();
        if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return FALSE;
        }
    }
    
    public function get_pohon($id=NULL)
    {
        $this->db->from('pohon');
        //$this->db->where('deleted_at', NULL);
		$this->db->where('satker_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
}