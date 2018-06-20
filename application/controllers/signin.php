<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        $this->load->model('signin_m');
	}

    public function index($res="ok")
    {
        $this->load->view('signin/header');
        $this->load->view('signin/index', array('res'=>$res));
        $this->load->view('signin/footer');
    }

    public function login()
    {
        $where = array(
            'email'     => $this->input->post('username'),       
            'password'  => md5($this->input->post('password')),
            'flagState' => 1
        );

        $user = $this->signin_m->get_user($where);

        if ($user == false) {
            redirect(site_url('signin/index/'.md5('false')));
        }else{

            $session = array(
                '10g!n' => 's3esAdm!',
                'userID' => $user[0]->userID,
                'userName' => $user[0]->name,
                'userEmail' => $user[0]->email
            );

            $locations = $this->signin_m->get_location($user[0]->userID);

            if ($locations != false) {
                $session['userLocation'] = $locations;
            }

            $this->session->set_userdata($session);

            redirect(site_url('signin/welcome'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url(),'refresh');
    }

    public function welcome()
    {
        if ($this->session->userdata('10g!n') != 's3esAdm!') {
           redirect(site_url(),'refresh');
        }

        $this->load->view('signin/header');
        $this->load->view('signin/welcome');
        $this->load->view('signin/footer'); 
    }
}
