<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indikator extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'rpjmd/indikator/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('identitas_helper');
		$this->load->model('indikator_m', 'data');
		signin();
		admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Indikator RPJMD';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Indikator RPJMD';
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
		
		$data['head'] 		= 'Edit Indikator RPJMD';
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
			$col[] = $row->visi;
			$col[] = $row->misi;
			$col[] = $row->tujuan;
			$col[] = $row->sasaran;
			//$col[] = strip_tags($row->visi).'<br>--- '.strip_tags($row->misi).'<br>------'.$row->tujuan.'<br>---------'.$row->sasaran;
			$col[] = $row->indikator;
			$col[] = $row->satuan;
			$col[] = $row->periode;
			
			//add html for action
			if(indikator($row->id)){
				$col[] = '<a class="btn btn-xs btn-flat btn-success" href="'.site_url('rpjmd/target/updated/'.$row->id).'" data-toggle="tooltip" title="Target"><i class="glyphicon glyphicon-ok-circle"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('rpjmd/indikator/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
				<a class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" title="Hapus" onclick="deleted('."'".$row->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			}else{
				$col[] = '<a class="btn btn-xs btn-flat btn-danger" href="'.site_url('rpjmd/target/created/'.$row->id).'" data-toggle="tooltip" title="Target"><i class="glyphicon glyphicon-remove-circle"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('rpjmd/indikator/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
				<a class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" title="Hapus" onclick="deleted('."'".$row->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		  
			}
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
//        $data = array(
//				'periode_id' => $this->input->post('periode_id'),
//				'visi_id' => $this->input->post('visi_id'),
//				'misi_id' => $this->input->post('misi_id'),
//				'tujuan_id' => $this->input->post('tujuan_id'),
//				'sasaran_id' => $this->input->post('sasaran_id'),
//				'indikator' => $this->input->post('indikator'),
//				'awal' => $this->input->post('awal'),
//				'akhir' => $this->input->post('akhir')
//            );      
		
        if($this->validation()){
			$indikator = $this->input->post('indikator');
			$result = array();
			foreach($indikator AS $key => $val){
				if($_POST['indikator'][$key] != ''){
					$result[] = array(
					 "periode_id"  => $this->input->post('periode_id'),
					 "visi_id"  => $this->input->post('visi_id'),
					 "misi_id"  => $this->input->post('misi_id'),
					 "tujuan_id"  => $_POST['tujuan'][$key],
					 "sasaran_id"  => $_POST['sasaran'][$key],
					 "indikator"  => $_POST['indikator'][$key],
					 "satuan_id"  => $_POST['satuan_id'][$key],
					);
				}
			}
            //$insert = $this->data->insert($data);
			$this->db->insert_batch('indikator', $result);
			helper_log("add", "Menambah Indikator RPJMD");
        }
    }
    
    public function ajax_update($id=null)
    {
        $data = array(
				'indikator' => $this->input->post('indikator'),
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
			helper_log("edit", "Merubah Indikator RPJMD");
        }
    }
    
    public function ajax_delete($id=null)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Indikator RPJMD");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Indikator RPJMD");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
		if(!isset($id)){
			$this->form_validation->set_rules("periode_id", "Periode RPJMD", "trim|required");
			$this->form_validation->set_rules("visi_id", "Visi RPJMD", "trim|required");
			$this->form_validation->set_rules("misi_id", "Misi RPJMD", "trim|required");
		}else{
			$this->form_validation->set_rules("indikator", "Indikator RPJMD", "trim|required");
			$this->form_validation->set_rules("satuan_id", "Satuan Indikator RPJMD", "trim|required");
		}
		//$this->form_validation->set_rules("tujuan_id", "Tujuan RPJMD", "trim|required");
		//$this->form_validation->set_rules("sasaran_id", "Sasaran RPJMD", "trim|required");
		//$this->form_validation->set_rules("indikator", "Indikator RPJMD", "trim|required");
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
						$data = array('class'=>'form-control','name'=>'indikator[]','id'=>'indikator','type'=>'text','value'=>set_value('indikator[]'),'placeholder'=>'Indikator Sasaran RPJMD');
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
	
	public function get_satuan(){
		$tujuan_id = $this->input->post('tujuan_id');
		$id = $this->input->post('id');

		echo '<div class="child"><br><input type="hidden" value="'.$tujuan_id.'" name="tujuan[]" id="tujuan'.$id.'"><input type="hidden" value="'.$id.'" name="sasaran[]" id="sasaran">';
		echo '<div class="input-group input-group"><div class="input-group-btn"><button class="btn btn-danger btn-flat add-button remove" data-number="'.$id.'" type="button" onclick="remove(this.getAttribute(\'data-number\'))"><i class="fa fa-minus"></i></button></div>';
		echo '<div class="col-md-8">';
		$data = array('class'=>'form-control','name'=>'indikator[]','id'=>'indikator','type'=>'text','value'=>set_value('indikator[]'),'placeholder'=>'Indikator Sasaran RPJMD');
		echo form_input($data);
		echo '</div><div class="col-md-4">';
		$selected = set_value('satuan_id');
		$satuan = $this->data->get_satuan();
		echo form_dropdown('satuan_id[]', $satuan, $selected, "class='form-control select2' name='satuan_id[]' id='satuan_id'");
		echo '</div></div></div>';
	}
}
