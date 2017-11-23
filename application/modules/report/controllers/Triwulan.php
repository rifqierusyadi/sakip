<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Triwulan extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'report/triwulan/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('triwulan_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
	}
	
	public function index()
	{
		$data['head'] 		= 'PENGUKURAN KINERJA TRIWULAN';
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
            $col[] = $row->periode;
			for($i = $row->awal; $i <= $row->akhir; $i++){
				if(realisasi($row->id, $i)){
					$indikator[] = '<a class="btn btn-xs btn-flat btn-success" href="'.site_url('report/triwulan/detail/'.$row->id.'/'.$i).'" data-toggle="tooltip" title="Target">'.$i.'</a>';
				}else{
					$indikator[] = '<a class="btn btn-xs btn-flat btn-danger" href="" data-toggle="tooltip" title="Target">'.$i.'</a>';
	
				}
			}

			$col[] = $indikator ? implode(" ", $indikator) : '-';
			
			//$col[] = $row->id;
            
            //add html for action
            //$col[] = '<a class="btn btn-xs btn-flat btn-info" onclick="edit_data();" href="'.site_url('report/triwulan/detail/'.$row->id).'" data-toggle="tooltip" title="Lihat"><i class="fa fa-file-text"></i></a>';
 
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
		$satker = $this->data->get_satker($this->session->userdata('satker'));
		
		$data['head'] 		= $satker ? 'PENGUKURAN KINERJA TRIWULAN - '.$satker->satker : 'PENGUKURAN KINERJA TRIWULAN';
		$data['record'] 	= $this->data->get_indikator();
		$data['content'] 	= $this->folder.'detail';
		//$data['style'] 		= $this->folder.'style';
		//$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}
}
