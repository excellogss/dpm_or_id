<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

	public function index()
	{
		//echo "halu";
		$this->load->view('welcome_message');
	}
}
