<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pejabat_m extends MY_Model
{
	public $table = 'pejabat'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array(null); //set kolom field database pada datatable secara berurutan
    public $column_search = array(); //set kolom field database pada datatable untuk pencarian
    public $order = array('id' => 'ASC'); //order baku 
	
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
		$record->visi_id = '';
		$record->misi_id = '';
		$record->tujuan = '';
		return $record;
    }
	
	public function get_record()
	{
		$query = $this->db->query('Select a.visi, b.misi, c. id, c.tujuan, d.periode from sakip_tujuan c LEFT JOIN sakip_visi a ON a.id = c.visi_id LEFT JOIN sakip_misi b ON b.id = c.misi_id LEFT JOIN sakip_ref_periode d on c.periode_id = d.id  WHERE c.deleted_at is NULL');
		if($query->num_rows() > 0 )
		{
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
         $this->db->select('a.*, b.periode');
		 $this->db->from('pejabat a');
		 $this->db->join('ref_periode b','a.periode_id = b.id','LEFT');
		// $this->db->join('visi c','a.visi_id = c.id','LEFT');
		// $this->db->join('misi d','a.misi_id = d.id','LEFT');
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
	
	public function get_visi($periode=null)
	{
        $query = $this->db->where('periode_id',$periode)->where('deleted_at',NULL)->order_by('id', 'ASC')->get('visi');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Salah Satu Visi';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->visi;
		}
        }else{
            $dropdown[''] = 'Belum Ada Visi Tersedia'; 
        }
		return $dropdown;
	}
	
	public function get_misi_edit($periode=null, $visi=null)
	{
        $query = $this->db->where('periode_id',$periode)->where('visi_id',$visi)->where('deleted_at',NULL)->order_by('id', 'ASC')->get('misi');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Salah Satu Misi';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->misi;
		}
        }else{
            $dropdown[''] = 'Belum Ada Misi Tersedia'; 
        }
		return $dropdown;
	}

	public function get_misi($periode=null, $visi=null)
    {
        $this->db->where('periode_id', $periode);
		$this->db->where('visi_id', $visi);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get('misi');
		if($query->num_rows() > 0){
			return $query->result();	
		}else{
			//show_404();
			return FALSE;
		}
        
    }

    public function get_jabatan($satker=null)
	{
        $query = $this->db->like('path',$satker)->get('view_jabatan');
        if($query->num_rows() > 0){
		    return $query->result();
        }else{
            return FALSE;
        }
    }
    
    public function get_tahun($periode=null)
	{
        $query = $this->db->where('id',$periode)->where('deleted_at',NULL)->order_by('id', 'ASC')->get('ref_periode')->row();
        if($query){
        	$dropdown[''] = 'Pilih Tahun';
			$awal = $query->awal;
			$akhir = $query->akhir;
			
			for ($i=$awal; $i <= $akhir; $i++){
				$dropdown[$i] = $i;
			}
			// foreach ($query->result() as $row)
			// {
			// 	$dropdown[] = $row->visi;
			// }
        }else{
            $dropdown[''] = 'Belum Periode Tahun Tersedia'; 
        }
		return $dropdown;
	}

}