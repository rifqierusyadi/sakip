<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpjmd extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'laporan/rpjmd/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rpjmd_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
	}
	
	public function index()
	{
		$periode = null;

		$data['head'] 		= $periode ? 'MATRIKS RPJMD <br>PERIODE '.$periode->periode : 'MATRIKS RPJMD';
		$data['record'] 	= FALSE;
		$data['periode'] 	= $this->data->get_periode();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}

	public function result()
	{
		$id = $this->input->post('periode');
		$periode = $this->db->get_where('ref_periode', array('id'=>$id))->row();
		
		$data['head'] 		= $periode ? 'MATRIKS RPJMD <br>PERIODE '.$periode->periode : 'MATRIKS RPJMD';
		$data['record'] 	= $this->data->get_data($id);
		$data['periode'] 	= $this->data->get_periode(1);
		$data['content'] 	= $this->folder.'result';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}
}
