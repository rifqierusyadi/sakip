<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_m extends MY_Model
{
	public $table = 'program'; // you MUST mention the table name
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
		$record->kode = '';
		$record->tahun = '';
		$record->jabatan_program = '';
		$record->program = '';
		$record->total = '';
		return $record;
    }
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
        $this->db->select('a.*, b.kode, b.program, b.total, b.satker_id, c.periode');
		$this->db->from('kegiatan a');
		$this->db->join('program b','a.program_id = b.id','LEFT');
		$this->db->join('ref_periode c','b.periode_id = c.id','LEFT');
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
	
	function get_detail($id=null)
    {
        $this->db->where('indikator_id', $id);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get('indikator_detail');
		if($query->num_rows() > 0){
			return $query->result();	
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
	
	public function get_misi($periode=null, $visi=null)
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
	
	public function get_tujuan_edit($periode=null, $visi=null, $misi=null)
	{
        $query = $this->db->where('periode_id',$periode)->where('visi_id',$visi)->where('misi_id',$misi)->where('deleted_at',NULL)->order_by('id', 'ASC')->get('tujuan');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Salah Satu Tujuan Misi';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->tujuan;
		}
        }else{
            $dropdown[''] = 'Belum Ada Tujuan Tersedia'; 
        }
		return $dropdown;
	}
	
	public function get_satuan()
	{
		$this->db->where('deleted_at',null);
		$query = $this->db->get('ref_satuan');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Satuan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->satuan;
		}
        }else{
            $dropdown[''] = 'Belum Ada Satuan'; 
        }
		return $dropdown;
	}

	public function get_sasaran_edit($periode=null, $visi=null, $misi=null, $tujuan=null)
	{
        $query = $this->db->where('periode_id',$periode)->where('visi_id',$visi)->where('misi_id',$misi)->where('tujuan_id',$tujuan)->where('deleted_at',NULL)->order_by('id', 'ASC')->get('sasaran');
        if($query->num_rows() > 0){
        $dropdown[''] = 'Pilih Salah Satu Sasaran Tujuan';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->sasaran;
		}
        }else{
            $dropdown[''] = 'Belum Ada Sasaran Tujuan Tersedia'; 
        }
		return $dropdown;
	}
	
	public function get_tujuan($periode=null, $visi=null, $misi=null)
    {
        $this->db->where('periode_id', $periode);
		$this->db->where('visi_id', $visi);
		$this->db->where('misi_id', $misi);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get('tujuan');
		if($query->num_rows() > 0){
			return $query->result();	
		}else{
			//show_404();
			return FALSE;
		}
    }
	
	public function get_sasaran($periode=null, $visi=null, $misi=null, $tujuan=null)
    {
        $this->db->where('periode_id', $periode);
		$this->db->where('visi_id', $visi);
		$this->db->where('misi_id', $misi);
		$this->db->where('tujuan_id', $tujuan);
		$this->db->where('deleted_at', NULL);
        $query = $this->db->get('sasaran');
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
		$dropdown[''] = 'PILIH SALAH SATU';
		foreach ($query->result() as $row)
		{
			$dropdown[$row->kode] = $row->jabatan;
		}
        }else{
            $dropdown[''] = 'Belum Ada Jabatan Tersedia'; 
        }
		return $dropdown;
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