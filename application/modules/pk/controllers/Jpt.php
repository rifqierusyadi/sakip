<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jpt extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'rpjmd/jpt/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jpt_m', 'data');
		signin();
		admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Perjanjian Kinerja Tingkat JPT';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		redirect('rpjmd/indikator');
		$this->load->view('template/default', $data);
	}
	
	public function created($id=null)
	{
		$data['head'] 		= 'Tambah Target Indikator RPJMD';
		$data['record'] 	= $this->data->get_record_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		
		$data['head'] 		= 'Ubah Target Indikator RPJMD';
		$data['record'] 	= $this->data->get_record_id($id);
		$data['detail'] 	= $this->data->get_detail($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
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
				$col[] = $row->jpt;
				$col[] = $row->satuan;
				$col[] = $row->periode;
			
				//add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" href="'.site_url('rpjmd/jpt/jpt/'.$row->id).'" data-toggle="tooltip" title="Target"><i class="glyphicon glyphicon-stats"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('rpjmd/jpt/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
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
	
	public function ajax_save($id=null)
    {
			if($this->validation($id)){
				$tahun = $this->input->post('tahun');
				$result = array();
				foreach($tahun AS $key => $val){
					$result[] = array(
					"indikator_id"  => $this->input->post('indikator_id'),
					"tahun"  => $_POST['tahun'][$key],
					"jpt"  => $_POST['jpt'][$key],
					);
				}
				$this->db->insert_batch('indikator_detail', $result);
				helper_log("add", "Menambah Perjanjian Kinerja Tingkat JPT");
			}
    }
    
    public function ajax_update($id=null)
    {
        if($this->validation($id)){
            // $update = $this->data->update($data, $id);
			$tahun = $this->input->post('tahun');
			$result = array();
			foreach($tahun AS $key => $val){
				$result[] = array(
				 "id"  => $_POST['id'][$key],
				 "indikator_id"  => $this->input->post('indikator_id'),
				 "tahun"  => $_POST['tahun'][$key],
				 "jpt"  => $_POST['jpt'][$key],
				);
			}
			//$insert = $this->data->insert($data);
			$this->db->update_batch('indikator_detail', $result, 'id');
			helper_log("edit", "Merubah jpt RPJMD");
        }
    }
    
    public function ajax_delete($id=null)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Perjanjian Kinerja Tingkat JPT");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Perjanjian Kinerja Tingkat JPT");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules("indikator_id", "Indikator RPJMD", "trim|required");
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
						$data = array('class'=>'form-control','name'=>'jpt[]','id'=>'jpt','type'=>'text','value'=>set_value('jpt[]'),'placeholder'=>'jpt Sasaran RPJMD');
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
		$data = array('class'=>'form-control','name'=>'jpt[]','id'=>'jpt','type'=>'text','value'=>set_value('jpt[]'),'placeholder'=>'jpt Sasaran RPJMD');
		echo form_input($data);
		echo '</div><div class="col-md-4">';
		$selected = set_value('satuan_id');
		$satuan = $this->data->get_satuan();
		echo form_dropdown('satuan_id[]', $satuan, $selected, "class='form-control select2' name='satuan_id[]' id='satuan_id'");
		echo '</div></div></div>';
	}
}