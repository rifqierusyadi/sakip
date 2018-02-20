<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pejabat extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'sopd/pejabat/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pejabat_m', 'data');
		signin();
		//admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Pejabat Administrasi';
		$data['record'] 	= $this->data->get_record();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Pejabat Administrasi';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['periode']	= $this->data->get_periode();
		$data['pangkat']	= $this->data->get_pangkat();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		
		$data['head'] 		= 'Edit Pejabat Administrasi';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['periode']	= $this->data->get_periode();
		$data['pangkat']	= $this->data->get_pangkat();
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_list()
    {
        $record	= $this->data->get_datatables();
        $data 	= array();
        $no 	= $_POST['start'];
		
        foreach ($record as $row) {
            $no++;
            $col = array();
            $col[] = '<input type="checkbox" class="data-check" value="'.$row->id.'">';
            $col[] = $row->jabatan;
			$col[] = $row->periode;
			$col[] = $row->tahun;
			$col[] = $row->nip;
			$col[] = $row->nama;
			
			//add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('sopd/pejabat/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" title="Hapus" onclick="deleted('."'".$row->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
            $data[] = $col;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->data->count_all(),
                        "recordsFiltered" => $this->data->count_filtered(),
                        "data" => $data,
                );
        
		echo json_encode($output);
    }
	
	public function ajax_save()
    {
        if($this->validation()){
			$pejabat = $this->input->post('jabatan');
			$result = array();
			foreach($pejabat AS $key => $val){
					$result[] = array(
					 "periode_id"  => $this->input->post('periode_id'),
					 "tahun"  => $this->input->post('tahun'),
					 "jabatan_id" => $_POST['jabatan_id'][$key],
					 "jabatan"  => $_POST['jabatan'][$key],
					 "nama"  => $_POST['nama'][$key],
					 "nip"  => $_POST['nip'][$key],
					 "pangkat"  => $_POST['pangkat'][$key],
					 "satker_id"  => $this->session->userdata('satker')
					);
			}
			
			$this->db->insert_batch('pejabat', $result);
			helper_log("add", "Menambah Pejabat Administrasi");
        }
    }
    
    public function ajax_update($id=null)
    {
        $data = array(
				'periode_id' => $this->input->post('periode_id'),
				'tahun' => $this->input->post('tahun'),
				'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama')
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Pejabat Administrasi");
        }
    }
    
    public function ajax_delete($id=null)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Pejabat Administrasi");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Pejabat Administrasi");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("periode_id", "Periode RPJMD", "trim|required");
		$this->form_validation->set_rules("tahun", "Tahun", "trim|required");
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        
        if($this->form_validation->run()){
            $data['success'] = true;
        }else{
            foreach ($_POST as $key => $value) {
                $data['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($data);
        return $this->form_validation->run();
    }
	
	public function get_visi(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $periode = $this->input->post('periode_id');
        $visi = $this->data->get_visi($periode);
        if(!empty($visi)){
            //$selected = (set_value('unker')) ? set_value('unker') : '';
			$selected = set_value('visi_id', $record->visi_id);
            echo form_dropdown('visi_id', $visi, $selected, "class='form-control select2' name='visi_id' id='visi_id'");
        }else{
            echo form_dropdown('visi_id', array(''=>'Pilih Visi RPJMD'), '', "class='form-control select2' name='visi_id' id='visi_id'");
        }
    }
	
	public function get_misi_edit(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $periode = $this->input->post('periode_id');
		$visi = $this->input->post('visi_id');
        $misi = $this->data->get_misi_edit($periode, $visi);
        if(!empty($misi)){
            //$selected = (set_value('unker')) ? set_value('unker') : '';
			$selected = set_value('misi_id', $record->misi_id);
            echo form_dropdown('misi_id', $misi, $selected, "class='form-control select2' name='misi_id' id='misi_id'");
        }else{
            echo form_dropdown('misi_id', array(''=>'Pilih Misi RPJMD'), '', "class='form-control select2' name='misi_id' id='misi_id'");
        }
    }

	public function get_jabatan(){
		//echo 'hallo';
        //$record = $this->data->get_id($this->uri->segment(4));
		$periode = $this->input->post('periode_id');
		$tahun = $this->input->post('tahun');
		$satker = $this->session->userdata('satker');
		$jabatan = $this->data->get_jabatan($satker);
		$pangkat = $this->data->get_pangkat();

        if(!empty($jabatan)){
			foreach($jabatan as $row){
				echo '<button class="btn btn-sm btn-flat btn-primary btn-block btn-social"><i class="fa fa-file"></i>'.$row->jabatan.'</button><br>';
				echo '<div id="wrapper'.$row->kode.'"><div id="child"><input type="hidden" value="'.$row->kode.'" name="jabatan_id[]" id="jabatan_id"><input type="hidden" value="'.$row->jabatan.'" name="jabatan[]" id="jabatan">';
				$data = array('class'=>'form-control','name'=>'nama[]','id'=>'nama','type'=>'text','value'=>set_value('nama[]'),'placeholder'=>'Nama Lengkap Berserta Gelar');
				echo form_input($data);
				echo '<br>';
				$data = array('class'=>'form-control','name'=>'nip[]','id'=>'nip','type'=>'text','value'=>set_value('nip[]'),'placeholder'=>'NIP');
				echo form_input($data);
				echo '<br>';
				echo form_dropdown('pangkat[]', $pangkat, '', "class='form-control select2' name='pangkat[]' id='pangkat'");
				echo '</div></div><br>';
				
			
			}  
        }else{
			echo '<button class="btn btn-sm btn-flat btn-danger btn-block">Belum Ada Misi Tersedia!</button>';
        }
	}
	
	public function get_tahun(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $periode = $this->input->post('periode_id');
        $tahun = $this->data->get_tahun($periode);
        if(!empty($tahun)){
            //$selected = (set_value('unker')) ? set_value('unker') : '';
			$selected = set_value('tahun', $record->tahun);
            echo form_dropdown('tahun', $tahun, $selected, "class='form-control select2' name='tahun' id='tahun'");
        }else{
            echo form_dropdown('tahun', array(''=>'Pilih Tahun'), '', "class='form-control select2' name='tahun' id='tahun'");
        }
    }
}
