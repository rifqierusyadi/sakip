<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rpjmd extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'report/rpjmd/';
	
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
		$data['head'] 		= 'MATRIKS RPJMD';
		$data['record'] 	= $this->data->get_data();
		$data['content'] 	= $this->folder.'detail';
		//$data['style'] 		= $this->folder.'style';
		//$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}
}
