<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index() {
		$this->load->view('comman/header');
		$this->load->view('test');
		$this->load->view('comman/footer');
	}
}