<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/access_m');
        
        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
    	$campos = array(
    		'roleID'   => 'r.roleID',
    		'location' => 'l.name as l',
    		'user'     => 'u.name as u',
    		'type'     => 'r.type',
    		'date'     => 'r.modifiedDate'
    	);

    	$tabla = array('role' => 'role as r');

    	$unir = array(
    		'table_1' => 'user as u',
    		'key_1'   => 'u.userID = r.userID',
    		'table_2' => 'location as l',
    		'key_2'   => 'l.locationID = r.locationID'
    	);

    	$donde = array('r.flagState' => 1);

		$accesos = $this->access_m->get($campos, $tabla, $unir, $donde);

        $informacion = array('acceso' => $accesos);
        
        return $this->load->view('logistics/access/index', $informacion);  
    }

    public function create()
    {
        $this->load->model('logistics/location_m');
        $this->load->model('logistics/user_m');

        $fields = array(
            'location' => array('id' => 'locationID', 'nombre' => 'name'),
            'user'     => array('id' => 'userID', 'nombre' => 'name')
        );

        $table = array(
            'location' => 'location',
            'user'     => 'user'
        );

        $where = array(
            'location' => array('flagState' => 1),
            'user'     => array('flagState' => 1) 
        );

        $locations = $this->location_m->get($fields['location'], $table['location'], $where['location']);
        $users     = $this->user_m->get($fields['user'], $table['user'], $where['user']);

        $data = array(
            'location' => $locations,
            'user'     => $users
        );

        return $this->load->view('logistics/access/create', $data);
    }

    public function store()
    {
        $data = array(
            'locationID' => $this->input->post('location'),
            'userID'     => $this->input->post('user'),
            'type'       => $this->input->post('type')
        );

        $medidas        = $this->input->post('medidas');
        $marcas         = $this->input->post('marcas');
        $areas          = $this->input->post('areas');
        $comprobantes   = $this->input->post('comprobantes');
        $documentos     = $this->input->post('documentos');
        $sucursales     = $this->input->post('sucursales');
        $usuarios       = $this->input->post('usuarios');
        $accesos        = $this->input->post('accesos');

        $productos      = $this->input->post('productos');
        $proveedores    = $this->input->post('proveedores');
        $pedidos        = $this->input->post('pedidos');
        $compras        = $this->input->post('compras');
        $distribuciones = $this->input->post('distribuciones');
        $kardex         = $this->input->post('kardex');
        $estadisticas   = $this->input->post('estadisticas');

        $data['measures']   = (!empty($medidas)) ? $medidas : 0 ;
        $data['brands']     = (!empty($marcas)) ? $marcas : 0 ;
        $data['areas']      = (!empty($areas)) ? $areas : 0 ;
        $data['receipts']   = (!empty($comprobantes)) ? $comprobantes : 0 ;
        $data['identities'] = (!empty($documentos)) ? $documentos : 0 ;
        $data['locations']  = (!empty($sucursales)) ? $sucursales : 0 ;
        $data['users']      = (!empty($usuarios)) ? $usuarios : 0 ;
        $data['access']     = (!empty($accesos)) ? $accesos : 0 ;

        $data['products']   = (!empty($productos)) ? $productos : 0 ;
        $data['suppliers']  = (!empty($proveedores)) ? $proveedores : 0 ;
        $data['orders']     = (!empty($pedidos)) ? $pedidos : 0 ;
        $data['inputs']     = (!empty($compras)) ? $compras : 0 ;
        $data['outputs']    = (!empty($distribuciones)) ? $distribuciones : 0 ;
        $data['kardex']     = (!empty($kardex)) ? $kardex : 0 ;
        $data['statistics'] = (!empty($estadisticas)) ? $estadisticas : 0 ;

        $result = $this->access_m->insert('role', $data);

        echo $result;
    }

    public function edit($id)
    {
        $this->load->model('logistics/location_m');
        $this->load->model('logistics/user_m');

        $fields = array(
            'location' => array('id' => 'locationID', 'nombre' => 'name'),
            'user'     => array('id' => 'userID', 'nombre' => 'name')
        );

        $table = array(
            'location' => 'location',
            'user'     => 'user'
        );

        $where = array(
            'location' => array('flagState' => 1),
            'user'     => array('flagState' => 1) 
        );

        $locations = $this->location_m->get($fields['location'], $table['location'], $where['location']);
        $users     = $this->user_m->get($fields['user'], $table['user'], $where['user']);
        $roles     = $this->access_m->get('*', 'role', FALSE, array('roleID' => $id, 'flagState' => 1));

        $data = array(
            'location' => $locations,
            'user'     => $users,
            'role'     => $roles
        );
        
        if ($roles != FALSE ) {
            return $this->load->view('logistics/access/edit', $data);
        } else {
            return $this->load->view('logistics/access');
        }    
    }

    public function update($id)
    {
        $data = array(
            'locationID' => $this->input->post('location'),
            'userID'     => $this->input->post('user'),
            'type'       => $this->input->post('type')
        );

        $medidas        = $this->input->post('medidas');
        $marcas         = $this->input->post('marcas');
        $areas          = $this->input->post('areas');
        $comprobantes   = $this->input->post('comprobantes');
        $documentos     = $this->input->post('documentos');
        $sucursales     = $this->input->post('sucursales');
        $usuarios       = $this->input->post('usuarios');
        $accesos        = $this->input->post('accesos');

        $productos      = $this->input->post('productos');
        $proveedores    = $this->input->post('proveedores');
        $pedidos        = $this->input->post('pedidos');
        $compras        = $this->input->post('compras');
        $distribuciones = $this->input->post('distribuciones');
        $kardex         = $this->input->post('kardex');
        $estadisticas   = $this->input->post('estadisticas');

        $data['measures']   = (!empty($medidas)) ? $medidas : 0 ;
        $data['brands']     = (!empty($marcas)) ? $marcas : 0 ;
        $data['areas']      = (!empty($areas)) ? $areas : 0 ;
        $data['receipts']   = (!empty($comprobantes)) ? $comprobantes : 0 ;
        $data['identities'] = (!empty($documentos)) ? $documentos : 0 ;
        $data['locations']  = (!empty($sucursales)) ? $sucursales : 0 ;
        $data['users']      = (!empty($usuarios)) ? $usuarios : 0 ;
        $data['access']     = (!empty($accesos)) ? $accesos : 0 ;

        $data['products']   = (!empty($productos)) ? $productos : 0 ;
        $data['suppliers']  = (!empty($proveedores)) ? $proveedores : 0 ;
        $data['orders']     = (!empty($pedidos)) ? $pedidos : 0 ;
        $data['inputs']     = (!empty($compras)) ? $compras : 0 ;
        $data['outputs']    = (!empty($distribuciones)) ? $distribuciones : 0 ;
        $data['kardex']     = (!empty($kardex)) ? $kardex : 0 ;
        $data['statistics'] = (!empty($estadisticas)) ? $estadisticas : 0 ;

        $result = $this->access_m->update('role', array('roleID' => $id, 'flagState' => 1), $data);

        echo $result;
    }

    public function destroy($id)
    {
        $result = $this->access_m->update('role', array('roleID' => $id), array('flagState' => 0));
        echo $result;
    }
}
