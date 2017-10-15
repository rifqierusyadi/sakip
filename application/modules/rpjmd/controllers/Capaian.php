<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capaian extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'rpjmd/capaian/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('capaian_m', 'data');
		signin();
		admin();
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Target Kinerja Makro Daerah';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		redirect('rpjmd/makro');
		$this->load->view('template/default', $data);
	}
	
	public function created($id=null)
	{
		$data['head'] 		= 'Tambah Target Kinerja Makro Daerah';
		$data['record'] 	= $this->data->get_record_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		$data['head'] 		= 'Ubah Target Kinerja Makro Daerah';
		$data['record'] 	= $this->data->get_record_id($id);
		$data['detail'] 	= $this->data->get_detail($id);
		$data['content'] 	= $this->folder.'form_edit';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
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
// 				$col[] = $row->capaian;
// 				$col[] = $row->satuan;
// 				$col[] = $row->periode;
			
// 				//add html for action
//             $col[] = '<a class="btn btn-xs btn-flat btn-info" href="'.site_url('rpjmd/capaian/capaian/'.$row->id).'" data-toggle="tooltip" title="Target"><i class="glyphicon glyphicon-stats"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('rpjmd/capaian/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
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
			if($this->validation($id)){
				$tahun = $this->input->post('tahun');
				$result = array();
				foreach($tahun AS $key => $val){
					$result[] = array(
					"makro_id"  => $this->input->post('makro_id'),
					"tahun"  => $_POST['tahun'][$key],
					"target"  => $_POST['target'][$key],
					);
				}
				$this->db->insert_batch('makro_detail', $result);
				helper_log("add", "Menambah Target Kinerja Makro Daerah");
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
					"makro_id"  => $this->input->post('makro_id'),
					"tahun"  => $_POST['tahun'][$key],
					"target"  => $_POST['target'][$key],
				);
			}
			//$insert = $this->data->insert($data);
			$this->db->update_batch('makro_detail', $result, 'id');
			helper_log("edit", "Merubah capaian RPJMD");
        }
    }
    
    // public function ajax_delete($id=null)
    // {
    //     $this->data->delete($id);
	// 	helper_log("trash", "Menghapus Target Kinerja Makro Daerah");
    //     echo json_encode(array("status" => TRUE));
    // }
    
    // public function ajax_delete_all()
    // {
    //     $list_id = $this->input->post('id');
    //     foreach ($list_id as $id) {
    //         $this->data->delete($id);
	// 		helper_log("trash", "Menghapus Target Kinerja Makro Daerah");
    //     }
    //     echo json_encode(array("status" => TRUE));
    // }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules("makro_id", "Makro Kinerja Daerah", "trim|required");
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