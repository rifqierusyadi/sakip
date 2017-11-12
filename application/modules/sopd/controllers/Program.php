<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'sopd/program/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('identitas_helper');
		$this->load->model('program_m', 'data');
		signin();
		//admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Program dan Kegiatan SOPD';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Program dan Kegiatan SOPD';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['periode']	= $this->data->get_periode();
		$data['satuan']		= $this->data->get_satuan();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		
		$data['head'] 		= 'Edit Program dan Kegiatan SOPD';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['periode']	= $this->data->get_periode();
		$data['satuan']		= $this->data->get_satuan();
		
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
			$col[] = $row->periode;
			$col[] = $row->kode;
			$col[] = $row->program;
			$col[] = number_format($row->total);
			$col[] = $row->rekening;
			$col[] = $row->kegiatan;
			$col[] = number_format($row->nilai);
			$col[] = '<a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('sopd/program/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
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
       $data = array(
				'periode_id' => $this->input->post('periode_id'),
				'kode' => $this->input->post('kode'),
				'program' => $this->input->post('program'),
				'total' => $this->input->post('total'),
				'satker_id' => 'S00030'
           );      
		
        if($this->validation()){
			$insert = $this->data->insert($data);
			$kegiatan = $this->input->post('kegiatan');
			$result = array();
			foreach($kegiatan AS $key => $val){
				if($_POST['kegiatan'][$key] != ''){
					$result[] = array(
					 "periode_id"  => $this->input->post('periode_id'),
					 "program_id"  => $insert,
					 "rekening"  => $_POST['rekening'][$key],
					 "kegiatan"  => $_POST['kegiatan'][$key],
					 "nilai"  => $_POST['nilai'][$key],
					 "satker_id"  => 'S00030'
					);
				}
			}
            //$insert = $this->data->insert($data);
			$this->db->insert_batch('kegiatan', $result);
			helper_log("add", "Menambah Program dan Kegiatan SOPD");
        }
    }
    
    public function ajax_update($id=null)
    {
        $data = array(
				'program' => $this->input->post('program'),
				'satuan_id' => $this->input->post('satuan_id')
            ); 
		
        if($this->validation($id)){
            // $update = $this->data->update($data, $id);
			// $nm = $this->input->post('target');
			// $result = array();
			// foreach($nm AS $key => $val){
			// 	$result[] = array(
			// 	 "id"  => $_POST['detail_id'][$key],
			// 	 "tahun"  => $_POST['tahun'][$key],
			// 	 "target"  => $_POST['target'][$key],
			// 	);
			// }
			//$insert = $this->data->insert($data);
			$this->data->update($data, $id);
			helper_log("edit", "Merubah Program SOPD");
        }
    }
    
    public function ajax_delete($id=null)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Program SOPD");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Program SOPD");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
			$this->form_validation->set_rules("periode_id", "Periode Anggaran", "trim|required");
			$this->form_validation->set_rules("kode", "Kode Program", "trim|required");
			$this->form_validation->set_rules("program", "Program", "trim|required");
		//$this->form_validation->set_rules("tujuan_id", "Tujuan RPJMD", "trim|required");
		//$this->form_validation->set_rules("sasaran_id", "Sasaran RPJMD", "trim|required");
		//$this->form_validation->set_rules("program", "Program SOPD", "trim|required");
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
	
	public function get_misi(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $periode = $this->input->post('periode_id');
		$visi = $this->input->post('visi_id');
        $misi = $this->data->get_misi($periode, $visi);
        if(!empty($misi)){
            //$selected = (set_value('unker')) ? set_value('unker') : '';
			$selected = set_value('misi_id', $record->misi_id);
            echo form_dropdown('misi_id', $misi, $selected, "class='form-control select2' name='misi_id' id='misi_id'");
        }else{
            echo form_dropdown('misi_id', array(''=>'Pilih Misi RPJMD'), '', "class='form-control select2' name='misi_id' id='misi_id'");
        }
    }
	
	public function get_tujuan_edit(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $periode = $this->input->post('periode_id');
		$visi = $this->input->post('visi_id');
		$misi = $this->input->post('misi_id');
        $tujuan = $this->data->get_tujuan($periode, $visi, $misi);
        if(!empty($tujuan)){
            //$selected = (set_value('unker')) ? set_value('unker') : '';
			$selected = set_value('tujuan_id', $record->tujuan_id);
            echo form_dropdown('tujuan_id', $tujuan, $selected, "class='form-control select2' name='tujuan_id' id='tujuan_id'");
        }else{
            echo form_dropdown('tujuan_id', array(''=>'Pilih Tujuan Misi RPJMD'), '', "class='form-control select2' name='tujuan_id' id='tujuan_id'");
        }
    }
	
	public function get_sasaran_edit(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
        $periode = $this->input->post('periode_id');
		$visi = $this->input->post('visi_id');
		$misi = $this->input->post('misi_id');
		$tujuan = $this->input->post('tujuan_id');
        $sasaran = $this->data->get_sasaran($periode, $visi, $misi, $tujuan);
        if(!empty($sasaran)){
            //$selected = (set_value('unker')) ? set_value('unker') : '';
			$selected = set_value('sasaran_id', $record->sasaran_id);
            echo form_dropdown('sasaran_id', $sasaran, $selected, "class='form-control select2' name='sasaran_id' id='sasaran_id'");
        }else{
            echo form_dropdown('sasaran_id', array(''=>'Pilih Sasaran Tujuan RPJMD'), '', "class='form-control select2' name='sasaran_id' id='sasaran_id'");
        }
    }
	
	public function get_tujuan(){
		$periode = $this->input->post('periode_id');
		$visi = $this->input->post('visi_id');
		$misi = $this->input->post('misi_id');
		$tujuan = $this->data->get_tujuan($periode, $visi, $misi);
        if(!empty($tujuan)){
			foreach($tujuan as $a){
				echo '<button class="btn btn-sm btn-flat btn-warning btn-block btn-social"><i class="fa fa-file-text"></i>'.$a->tujuan.'</button>';
				$sasaran = $this->data->get_sasaran($periode, $visi, $misi, $a->id);
				if($sasaran){
					foreach($sasaran as $b){
						echo '<button class="btn btn-sm btn-flat btn-danger btn-block btn-social"><i class="fa fa-file-text-o"></i>'.$b->sasaran.'</button><br>';
						echo '<div id="wrapper'.$b->id.'"><div id="child"><input type="hidden" value="'.$b->tujuan_id.'" name="tujuan[]" id="tujuan'.$b->id.'"><input type="hidden" value="'.$b->id.'" name="sasaran[]" id="sasaran">';
						echo '<div class="input-group input-group"><div class="input-group-btn"><button class="btn btn-info btn-flat add-button" data-number="'.$b->id.'" type="button" onclick="tambah(this.getAttribute(\'data-number\'))"><i class="fa fa-plus"></i></button></div>';
						echo '<div class="col-md-8">';
						$data = array('class'=>'form-control','name'=>'program[]','id'=>'program','type'=>'text','value'=>set_value('program[]'),'placeholder'=>'Indikator Sasaran RPJMD');
						echo form_input($data);
						echo '</div><div id="satuan"><div class="col-md-4">';
						$selected = set_value('satuan_id');
						$satuan = $this->data->get_satuan();
						echo form_dropdown('satuan_id[]', $satuan, $selected, "class='form-control select2' name='satuan_id[]' id='satuan_id'");
						echo '</div></div></div></div></div><br>';
					}
				}
			}  
        }else{
			echo '<button class="btn btn-sm btn-flat btn-danger btn-block">Belum Ada Misi Tersedia!</button>';
        }
	}
	
	public function get_kegiatan(){
		//$tujuan_id = $this->input->post('tujuan_id');
		//$id = $this->input->post('id');

		echo '<div class="child"><br><input type="hidden" value="'.$tujuan_id.'" name="tujuan[]" id="tujuan'.$id.'"><input type="hidden" value="'.$id.'" name="sasaran[]" id="sasaran">';
		echo '<div class="input-group input-group"><div class="input-group-btn"><button class="btn btn-danger btn-flat add-button remove" data-number="'.$id.'" type="button" onclick="remove(this.getAttribute(\'data-number\'))"><i class="fa fa-minus"></i></button></div>';
		echo '<div class="col-md-8">';
		$data = array('class'=>'form-control','name'=>'program[]','id'=>'program','type'=>'text','value'=>set_value('program[]'),'placeholder'=>'Indikator Sasaran RPJMD');
		echo form_input($data);
		echo '</div><div class="col-md-4">';
		$selected = set_value('satuan_id');
		$satuan = $this->data->get_satuan();
		echo form_dropdown('satuan_id[]', $satuan, $selected, "class='form-control select2' name='satuan_id[]' id='satuan_id'");
		echo '</div></div></div>';
	}
}
