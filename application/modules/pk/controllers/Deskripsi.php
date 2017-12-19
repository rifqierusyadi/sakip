<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deskripsi extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'pk/deskripsi/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('deskripsi_m', 'data');
		signin();
		//admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Penjelasan Indikator Kinerja';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		redirect('pk/indikator');
		$this->load->view('template/default', $data);
	}
	
	public function created($id=null)
	{
		$satker = $this->session->userdata('satker');
		$data['head'] 		= 'Tambah Penjelasan Indikator Kinerja';
		$data['record'] 	= $this->data->get_record_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['jabatan'] 	= $this->data->get_jabatan($satker);
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		$satker = $this->session->userdata('satker');
		$data['head'] 		= 'Ubah Penjelasan Indikator Kinerja';
		$data['record'] 	= $this->data->get_record_id($id);
		$data['row'] 		= $this->data->get_id($id);
		$data['bidang'] 	= $this->data->get_bidang_id($id);
		$data['detail'] 	= $this->data->get_detail($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['jabatan'] 	= $this->data->get_jabatan($satker);
		
		$this->load->view('template/default', $data);
	}
	
// 	public function ajax_list()
//     {
//         $record	= $this->data->get_datatables();
//         $data 	= array();
//         $no 	= $_POST['start'];
		
//         foreach ($record as $row) {
//          	$no++;
//          	$col = array();
//          	$col[] = '<input type="checkbox" class="data-check" value="'.$row->id.'">';
// 				$col[] = $row->visi;
// 				$col[] = $row->misi;
// 				$col[] = $row->tujuan;
// 				$col[] = $row->sasaran;
// 				//$col[] = strip_tags($row->visi).'<br>--- '.strip_tags($row->misi).'<br>------'.$row->tujuan.'<br>---------'.$row->sasaran;
// 				$col[] = $row->deskripsi;
// 				$col[] = $row->satuan;
// 				$col[] = $row->periode;
			
// 				//add html for action
//             $col[] = '<a class="btn btn-xs btn-flat btn-info" href="'.site_url('rpjmd/deskripsi/deskripsi/'.$row->id).'" data-toggle="tooltip" title="Target"><i class="glyphicon glyphicon-stats"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('rpjmd/deskripsi/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
//                   <a class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" title="Hapus" onclick="deleted('."'".$row->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
//             $data[] = $col;
//         }
 
//         $output = array(
//                         "draw" => $_POST['draw'],
//                         "recordsTotal" => $this->data->count_all(),
//                         "recordsFiltered" => $this->data->count_filtered(),
//                         "data" => $data,
//                 );
        
// 		echo json_encode($output);
//     }
	
	public function ajax_save($id=null)
    {
		//$kode = $this->data->get_kode();
		$data = array(
			'indikator_id' => $this->input->post('indikator_id'),
			'deskripsi' => $this->input->post('deskripsi'),
			'sumber' => $this->input->post('sumber'),
		);
	
		if($this->validation()){
			$insert = $this->data->insert($data);
			$bidang = $this->input->post('bidang_id');
			$result = array();
			foreach($bidang AS $key => $val){
				if($_POST['bidang_id'][$key] != ''){
					$result[] = array(
					 "indikator_id" => $this->input->post('indikator_id'),
					 "deskripsi_id"  => $insert,
					 "jabatan"  => $_POST['bidang_id'][$key]
					);
				}
			}
			$this->db->insert_batch('pohon_jabatan', $result);
			helper_log("add", "Menambah Penjelasan Indikator Kinerja");
		}
    }
    
    public function ajax_update($id=null)
    {
        $data = array(
			'indikator_id' => $this->input->post('indikator_id'),
			'deskripsi' => $this->input->post('deskripsi'),
			'sumber' => $this->input->post('sumber'),
		);
		
		$get_id = $this->db->get_where('pohon_deskripsi', array('indikator_id'=>$id))->row()->id;
		if($this->validation($get_id)){
			$update = $this->data->update($data, $get_id);
			$bidang = $this->input->post('bidang_id');
			$delete = $this->db->delete('pohon_jabatan', array('indikator_id'=>$this->input->post('indikator_id'), 'deskripsi_id'=>$get_id));
			if($delete){
				foreach($bidang AS $key => $val){
					if($_POST['bidang_id'][$key] != ''){
						$result[] = array(
						 "indikator_id" => $this->input->post('indikator_id'),
						 "deskripsi_id"  => $get_id,
						 "jabatan"  => $_POST['bidang_id'][$key]
						);
					}
				}
				$this->db->insert_batch('pohon_jabatan', $result);
			}
			helper_log("edit", "Merubah Penjelasan Indikator Kinerja");
		}
    }
    
    // public function ajax_delete($id=null)
    // {
    //     $this->data->delete($id);
	// 	helper_log("trash", "Menghapus Penjelasan Indikator Kinerja");
    //     echo json_encode(array("status" => TRUE));
    // }
    
    // public function ajax_delete_all()
    // {
    //     $list_id = $this->input->post('id');
    //     foreach ($list_id as $id) {
    //         $this->data->delete($id);
	// 		helper_log("trash", "Menghapus Penjelasan Indikator Kinerja");
    //     }
    //     echo json_encode(array("status" => TRUE));
    // }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules("indikator_id", "Indikator Kinerja", "trim|required");
		$this->form_validation->set_rules("deskripsi", "Penjelasan Indikator Kinerja", "trim|required");
		$this->form_validation->set_rules("sumber", "Sumber Data Indikator Kinerja", "trim|required");
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