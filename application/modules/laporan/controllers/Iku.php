<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iku extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'laporan/iku/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('iku_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
	}
	
	public function index()
	{
		$periode = null;

		$data['head'] 		= $periode ? 'INDIKATOR KINERJA UTAMA <br>PERIODE '.$periode->periode : 'INDIKATOR KINERJA UTAMA';
		$data['record'] 	= FALSE;
		$data['periode'] 	= $this->data->get_periode();
		$data['satker'] 	= $this->data->get_satker();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}

	public function result()
	{
		$id = $this->input->post('periode');
		$satker = $this->input->post('satker');
		$periode = $this->db->get_where('ref_periode', array('id'=>$id))->row();
		
		$data['head'] 		= $periode ? 'INDIKATOR KINERJA UTAMA <br>PERIODE '.$periode->periode : 'INDIKATOR KINERJA UTAMA';
		$data['record'] 	= $this->data->get_data($id, $satker);
		$data['periode'] 	= $this->data->get_periode();
		$data['satker'] 	= $this->data->get_satker();
		$data['content'] 	= $this->folder.'result';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}
}
