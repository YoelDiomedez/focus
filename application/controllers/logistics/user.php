<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/user_m');
        
        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
    	$fields = array(
    		'id'     => 'userID', 
    		'nombre' => 'name',
            'email'  => 'email'
    	);

    	$table = array('table' => 'user');
    	$where = array('flagState' => 1);
        $users = $this->user_m->get($fields, $table, $where);
        $data  = array('user' => $users);
        //echo "<pre>"; print_r($data); echo "</pre>";
        return $this->load->view('logistics/user/index', $data);
    }

    public function create()
    {
        return $this->load->view('logistics/user/create');
    }

    public function store()
    {
        $password = $this->input->post('password');
        unset($_POST['password']);
        $_POST = array('password' => md5($password)) + $_POST;

        $result = $this->user_m->insert('user', $_POST);
        echo $result;
    }

    public function edit($id)
    {
        $fields = array(
            'nombre' => 'name',
            'email'  => 'email'
        );

        $table  = array('table' => 'user');

        $where  = array(
            'flagState'  => 1, 
            'userID' => $id
        );

        $user  = $this->user_m->get($fields, $table, $where);

        echo json_encode($user);
    }

    public function update($id)
    {
        $password = $this->input->post('password');

        if (!empty($password)) {
            unset($_POST['password']);
            $_POST = array('password' => md5($password)) + $_POST;
        }else{
            unset($_POST['password']);
        }

        $where  = array('flagState' => 1, 'userID' => $id);
        $result = $this->user_m->update('user', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('userID' => $id);
        $data   = array('flagState' => 0);
        $result =  $this->user_m->update('user', $where, $data);
        echo $result;
    }
}
