<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunan extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'report/tahunan/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tahunan_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
	}
	
	public function index()
	{
		$periode = null;
		$tahunan = null;

		$data['head'] 		= $periode ? 'LAPORAN PENGUKURAN KINERJA TAHUNAN<br>PERIODE '.$periode->periode : 'LAPORAN PENGUKURAN KINERJA TAHUNAN';
		$data['record'] 	= FALSE;
		$data['periode'] 	= $this->data->get_periode();
		$data['satker'] 	= $this->data->get_satker();
		$data['tahunan'] 	= $tahunan;
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}

	public function result()
	{
		$id = $this->input->post('periode');
		$tahun = $this->input->post('tahun');
		$satker = $this->input->post('satker');
		$jabatan = $this->input->post('jabatan');
		$tahunan = $this->input->post('tahunan');

		$periode = $this->db->get_where('ref_periode', array('id'=>$id))->row();
		
		$data['head'] 		= $periode ? 'LAPORAN PENGUKURAN KINERJA TAHUNAN <br>PERIODE '.$periode->periode : 'LAPORAN PENGUKURAN KINERJA TAHUNAN';
		$data['record'] 	= $this->data->get_data($id, $tahun, $satker, $jabatan, $tahunan);
		$data['periode'] 	= $this->data->get_periode();
		$data['satker'] 	= $this->data->get_satker();
		$data['tahunan'] 	= $tahunan;
		$data['tahun'] 		= $tahun;
		$data['content'] 	= $this->folder.'result';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}

	public function get_tahun(){
		$periode = $this->input->post('periode');
        $tahun = $this->data->get_tahun($periode);
        if(!empty($tahun)){
            echo form_dropdown('tahun', $tahun, '', "class='form-control select2' name='tahun' id='tahun'");
        }else{
            echo form_dropdown('tahun', array(''=>'Pilih Tahun'), '', "class='form-control select2' name='tahun' id='tahun'");
        }
	}
	
	public function get_jabatan(){
		$satker = $this->input->post('satker');
        $jabatan = $this->data->get_jabatan($satker);
        if(!empty($jabatan)){
            echo form_dropdown('jabatan', $jabatan, '', "class='form-control select2' name='jabatan' id='jabatan'");
        }else{
            echo form_dropdown('jabatan', array(''=>'Pilih Jabatan'), '', "class='form-control select2' name='jabatan' id='jabatan'");
        }
    }
}
