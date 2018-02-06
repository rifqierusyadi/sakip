<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tupoksi extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'tupoksi/tupoksi/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tupoksi_m', 'data');
		signin();
		admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Tugas Pokok Dan Fungsi';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Tugas Pokok Dan Fungsi';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['periode']	= $this->data->get_periode();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		
		$data['head'] 		= 'Edit Tugas Pokok Dan Fungsi';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['periode']	= $this->data->get_periode();
		
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
            $col[] = $row->tugas;
			$col[] = $row->fungsi;
			
			//add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('tupoksi/tupoksi/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
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
        //$kode = $this->data->get_kode();
		$data = array(
				'satker_id' => $this->session->userdata('satker'),
				'tugas' => $this->input->post('tugas'),
				'fungsi' => $this->input->post('fungsi'),
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Tugas Pokok Dan Fungsi");
        }
    }
    
    public function ajax_update($id=null)
    {
        $data = array(
			'satker_id' => $this->session->userdata('satker'),
			'tugas' => $this->input->post('tugas'),
			'fungsi' => $this->input->post('fungsi'),
		);
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Tugas Pokok Dan Fungsi");
        }
    }
    
    public function ajax_delete($id=null)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Tugas Pokok Dan Fungsi");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Tugas Pokok Dan Fungsi");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("tugas", "Tugas Pokok Dan Fungsi", "trim|required");
		$this->form_validation->set_rules("fungsi", "Tugas Pokok Dan Fungsi", "trim|required");
		
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
}
