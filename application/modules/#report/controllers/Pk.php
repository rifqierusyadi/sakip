<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pk extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'report/pk/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pk_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
	}
	
	public function index()
	{
		$data['head'] 		= 'PERJANJIAN KINERJA';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
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
            $col[] = $row->kode;
			$col[] = $row->jabatan;
            
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" onclick="edit_data();" href="'.site_url('report/pk/detail/'.$row->id).'" data-toggle="tooltip" title="Lihat"><i class="fa fa-file-text"></i></a>
                  ';
 
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
	
	public function detail($id)
	{

		$jabatan = $this->data->get_jabatan($id);
		
		$data['head'] 		= $jabatan ? 'LAMPIRAN PERJANJIAN KINERJA - '.$jabatan->jabatan : 'LAMPIRAN PERJANJIAN KINERJA';
		$data['record'] 	= $this->data->get_indikator($jabatan->kode);
		$data['content'] 	= $this->folder.'detail';
		//$data['style'] 		= $this->folder.'style';
		//$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}
}
