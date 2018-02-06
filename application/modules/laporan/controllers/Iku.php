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
		$jabatan = $this->input->post('jabatan');
		$periode = $this->db->get_where('ref_periode', array('id'=>$id))->row();
		
		$nama_satker = $this->db->get_where('ref_satker', array('kode'=>$satker))->row();
		$nama_satker = $nama_satker ? $nama_satker->satker.'<br>' : '';

		$nama_jabatan = $this->db->get_where('ref_jabatan', array('kode'=>$jabatan))->row();
		$nama_jabatan = $nama_jabatan ? $nama_jabatan->jabatan.'<br>' : '';

		$tugas = $this->db->get_where('tupoksi', array('satker_id'=>$this->input->post('satker'), 'deleted_at'=>null),1)->row();
		$tugas = $tugas ? $tugas->tugas : '-';

		$fungsi = $this->db->get_where('tupoksi', array('satker_id'=>$this->input->post('satker'), 'deleted_at'=>null),1)->row();
		$fungsi = $fungsi ? $fungsi->fungsi : '-';

		$data['head'] 		= $periode ? 'INDIKATOR KINERJA UTAMA <br>'.$nama_jabatan.$nama_satker.'PERIODE '.$periode->periode : 'INDIKATOR KINERJA UTAMA';
		$data['record'] 	= $this->data->get_data($id, $satker, $jabatan);
		$data['periode'] 	= $this->data->get_periode();
		$data['satker'] 	= $this->data->get_satker();
		$data['content'] 	= $this->folder.'result';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';

		$data['data']		= array('satker'=>$nama_satker,'tugas'=>$tugas,'fungsi'=>$fungsi);
		
		$this->load->view($data['content'], $data);
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
