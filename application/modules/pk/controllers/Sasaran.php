<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'pk/sasaran/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('my_helper');
		$this->load->model('sasaran_m', 'data');
		signin();
		//admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Pohon Kinerja';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Pohon Kinerja';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['periode']	= $this->data->get_periode();
		$data['eselon']		= $this->data->get_eselon();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		
		$data['head'] 		= 'Edit Pohon Kinerja';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['periode']	= $this->data->get_periode();
		$data['eselon']		= $this->data->get_eselon();
		
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
           //$col[] = strip_tags($row->visi).'<br>--- '.strip_tags($row->misi).'<br>------'.$row->tujuan;
		   	$col[] = eselon($row->eselon_id);
		   	$col[] = $row->sasaran;
			$col[] = $row->periode;
			//add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" href="'.site_url('pk/indikator/'.$row->id).'" data-toggle="tooltip" title="Indikator"><i class="glyphicon glyphicon-list"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('pk/sasaran/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
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
			$sasaran = $this->input->post('sasaran');
			$result = array();
			foreach($sasaran AS $key => $val){
				if($_POST['sasaran'][$key] != ''){
					$result[] = array(
					 "periode_id"  => $this->input->post('periode_id'),
					 "eselon_id"  => $this->input->post('eselon_id'),
					 "parent_id" => $this->input->post('parent_id'),
					 "sasaran"  => $_POST['sasaran'][$key],
					 "satker_id"  => $this->session->userdata('satker'),
					 "order_id"  => $key+1
					);
				}
			}
			$this->db->insert_batch('pohon', $result);
			helper_log("add", "Menambah Pohon Kinerja");
        }
    }
    
    public function ajax_update($id=null)
    {
        $data = array(
				'periode_id' => $this->input->post('periode_id'),
				'eselon_id' => $this->input->post('eselon_id'),
				'parent_id' => $this->input->post('parent_id'),
				'sasaran' => $this->input->post('sasaran')
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Pohon Kinerja");
        }
    }
    
    public function ajax_delete($id=null)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Pohon Kinerja");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Pohon Kinerja");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("periode_id", "Periode Kinerja", "trim|required");
		$this->form_validation->set_rules("eselon_id", "Tingkat Jabatan", "trim|required");
		
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
	
	public function get_parent(){
		//echo 'hallo';
        $record = $this->data->get_id($this->uri->segment(4));
		$periode = $this->input->post('periode_id');
		$eselon = $this->input->post('eselon_id');
        $parent = $this->data->get_parent($periode, $eselon);
        if(!empty($parent)){
            //$selected = (set_value('unker')) ? set_value('unker') : '';
			$selected = set_value('parent_id', $record->parent_id);
            echo form_dropdown('parent_id', $parent, $selected, "class='form-control select2' name='parent_id' id='parent_id'");
        }else{
            echo form_dropdown('parent_id', array(''=>'Pilih Sasaran Kinerja Induk'), '', "class='form-control select2' name='parent_id' id='parent_id'");
        }
    }
}
