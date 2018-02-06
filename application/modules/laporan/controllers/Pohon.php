<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pohon extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'laporan/pohon/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pohon_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
	}
	
	public function index()
	{
		$periode = null;

		$data['head'] 		= $periode ? 'POHON KINERJA <br>PERIODE '.$periode->periode : 'POHON KINERJA';
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
		$id = $this->uri->segment(4);
		$satker = $this->uri->segment(5);
		$periode = $this->db->get_where('ref_periode', array('id'=>$id))->row();
		$nama_satker = $this->db->get_where('ref_satker', array('kode'=>$satker))->row();

		$data['head'] 		= $periode ? 'POHON KINERJA <br>'.$nama_satker->satker.'<br>PERIODE '.$periode->periode : 'POHON KINERJA';
		$data['record'] 	= $this->data->get_data($id, $satker);
		$data['periode'] 	= $this->data->get_periode();
		$data['satker'] 	= $this->data->get_satker();
		$data['content'] 	= $this->folder.'result';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}
}
