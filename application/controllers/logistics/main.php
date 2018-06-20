<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();

        $this->load->model('signin_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index($locationID)
    {
        $roles = $this->signin_m->get_role($locationID);

        if ($roles == false) {
            redirect(site_url('signin/welcome'));
        } else {
            
            $this->session->set_userdata($roles);
            
            $this->load->view('header');
            $this->load->view('menutop');
            $this->load->view('menuside');
            $this->load->view('content');
            $this->load->view('footer');
        }
    }
}
