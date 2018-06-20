<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
        $this->load->model('logistics/product_m');
        
        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
        $fields = array(
            'id'      => 'p.productID',
            'area'    => 'a.name as area',
            'marca'   => 'b.name as brand',
            'detalle' => 'p.detail', 
            'stock'   => 'i.quantity as stock',
            'estado'  => 'p.status',
            'medida'  => 'group_concat(m.unit) as unit',
            'tipo'    => 'group_concat(pm.type) as type'
        );

        $table = array('table' => 'product as p');

        $join = array(
            'table_1' => 'brand as b',
            'key_1'   => 'b.brandID = p.brandID',
            'table_2' => 'area as a',
            'key_2'   => 'a.areaID = p.areaID',
            'table_3' => 'productmeasure as pm',
            'key_3'   => 'pm.productID = p.productID',
            'table_4' => 'measure as m',
            'key_4'   => 'm.measureID = pm.measureID',
            'table_5' => 'inventory as i',
            'key_5'   => 'i.productID = p.productID',
            'table_6' => 'location as l',
            'key_6'   => 'l.locationID = i.locationID'
        );

        $where = array();

        if ($this->session->userdata('0')->locationID == 1) {
            $where['p.flagState'] = 1;
            $where['l.locationID'] = 1;
        } else {
            $where['l.locationID'] = $this->session->userdata('0')->locationID;
        }

        $group = array(
            'product' => 'p.productID',
            'stock'   => 'i.quantity'
        );

        $products = $this->product_m->get($fields, $table, $join, $where, $group);

        $data = array('product' => $products);
        
        return $this->load->view('logistics/product/index', $data);  
    }

    public function create()
    {
        $this->load->model('logistics/area_m');
        $this->load->model('logistics/brand_m');
        $this->load->model('logistics/measure_m');

        $fields = array(
            'area' => array('id' => 'areaID', 'nombre' => 'name'),
            'brand' => array('id' => 'brandID', 'nombre' => 'name'), 
            'measure' => array('id' => 'measureID', 'nombre' => 'unit')
        );

        $table = array(
            'area' => 'area',
            'brand' => 'brand',
            'measure' => 'measure'
        );

        $where = array(
            'area' => array('flagState' => 1),
            'brand' => array('flagState' => 1),
            'measure' => array('flagState' => 1) 
        );

        $areas = $this->area_m->get($fields['area'], $table['area'], $where['area']);
        $brands = $this->brand_m->get($fields['brand'], $table['brand'], $where['brand']);
        $measures = $this->measure_m->get($fields['measure'], $table['measure'], $where['measure']);

        $data = array(
            'area' => $areas,
            'brand' => $brands,
            'measure' => $measures
        );

        return $this->load->view('logistics/product/create', $data);
    }

    public function store()
    {
        $product = array(
            'areaID'   => $this->input->post('area'),
            'brandID'  => $this->input->post('marca'),
            'detail'   => $this->input->post('detalle'),
            'stockMin' => $this->input->post('minimo'),
        );

        if ($_FILES['imagen']['name'] <> '' || $_FILES['imagen']['name'] <> null) {
            $data                    = array();
            $config['upload_path']   = './resources/img/logistics/product/';
            $config['allowed_types'] = 'jpg|png';
            $config['encrypt_name']  = true;
            $config['max_size']      = 1024;
            //
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('imagen')){
                echo $this->upload->display_errors();
                return;
            }
            $data = $this->upload->data();
            $product['imagePath'] = $data['file_name']; 
        }

        $inventory = array(
            'shelf' => $this->input->post('mueble'),
            'bin'   => $this->input->post('nivel') 
        );

        $measure   = array();
        $measure_p = array();
        $measure_d = array();

        if (count($this->input->post('unidad')) == 1) {

            $measure['measureID'] = $this->input->post('unidad')[0];
        }
        else{

            $measure_p['measureID'] = $this->input->post('unidad')[0];
            $measure_d['measureID'] = $this->input->post('unidad')[1];
            $measure_d['type'] = 1;
        }
        try {
            $this->db->trans_begin(); 
            // insert into product
            $this->product_m->insert('product', $product);
            $productID = $this->product_m->last_insert_id();

            // insert into inventory
            $inventory = array('productID' => $productID[0]->id) + $inventory;
            $this->product_m->insert('inventory', $inventory);

            // insert into productMeasure
            if(!empty($measure)){
                $measure = array('productID' => $productID[0]->id) + $measure;
                $this->product_m->insert('productmeasure', $measure);
            }
            else{
                $measure_p = array('productID' => $productID[0]->id) + $measure_p;
                $measure_d = array('productID' => $productID[0]->id) + $measure_d;
                $this->product_m->insert('productmeasure', $measure_p);
                $this->product_m->insert('productmeasure', $measure_d);
            }

            if ($this->db->trans_status() === FALSE){
                throw new Exception('Algo salió mal, vuele a intentar.');
            }
            else{
                $this->db->trans_commit();
                echo $productID[0]->id;
            }

        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo $e->getMessage();
        }
    }

    public function show($id)
    {
        $fields = array(
            'id'      => 'p.productID',
            'detalle' => 'p.detail', 
            'minimo'  => 'p.stockMin',
            'imagen'  => 'p.imagePath',
            'estante' => 'i.shelf',
            'compart' => 'i.bin',
            'unidad'  => 'l.name as location'
        );

        $table = array('table' => 'product as p');

        $join = array(
            'table_1' => 'inventory as i',
            'key_1'   => 'i.productID = p.productID',
            'table_2' => 'location as l',
            'key_2'   => 'l.locationID = i.locationID'
        );

        $where = array();

        if ($this->session->userdata('0')->locationID == 1) {
            $where['p.productID'] = $id;
            $where['p.flagState'] = 1;
            $where['l.locationID'] = 1;
        } else {
            $where['p.productID'] = $id;
            $where['l.locationID'] = $this->session->userdata('0')->locationID;
        }

        $product = $this->product_m->get($fields, $table, $join, $where);

        $data = array('p' => $product);

        return $this->load->view('logistics/product/show', $data);  
    }

    public function edit($id)
    {
        if ($this->session->userdata('0')->locationID == 1) {
            $f = array(
                'id'      => 'p.productID',
                'area'    => 'p.areaID',
                'marca'   => 'p.brandID',
                'detalle' => 'p.detail',
                'minimo'  => 'p.stockMin',
                'imagen'  => 'p.imagePath',
                'estado'  => 'p.status',
                'medida'  => 'group_concat(m.measureID) as measure',
                'tipo'    => 'group_concat(pm.type) as type',
                'estante' => 'i.shelf',
                'compart' => 'i.bin'
            );

            $t = array('table' => 'product as p');

            $j = array(
                'table_1' => 'productmeasure as pm',
                'key_1'   => 'pm.productID = p.productID',
                'table_2' => 'measure as m',
                'key_2'   => 'm.measureID = pm.measureID',
                'table_3' => 'inventory as i',
                'key_3'   => 'i.productID = p.productID'
            );

            $w = array(
                'p.productID' => $id,
                'p.flagState' => 1
            );

            $g = array(
                'product' => 'p.productID',
                'estante' => 'i.shelf',
                'compart' => 'i.bin'
            );

            $product = $this->product_m->get($f, $t, $j, $w, $g);
            
            $this->load->model('logistics/area_m');
            $this->load->model('logistics/brand_m');
            $this->load->model('logistics/measure_m');

            $fields = array(
                'area' => array('id' => 'areaID', 'nombre' => 'name'),
                'brand' => array('id' => 'brandID', 'nombre' => 'name'), 
                'measure' => array('id' => 'measureID', 'nombre' => 'unit')
            );

            $table = array(
                'area' => 'area',
                'brand' => 'brand',
                'measure' => 'measure'
            );

            $where = array(
                'area' => array('flagState' => 1),
                'brand' => array('flagState' => 1),
                'measure' => array('flagState' => 1) 
            );
            
            $areas = $this->area_m->get($fields['area'], $table['area'], $where['area']);
            $brands = $this->brand_m->get($fields['brand'], $table['brand'], $where['brand']);
            $measures = $this->measure_m->get($fields['measure'], $table['measure'], $where['measure']);

            $data = array(
                'p' => $product,
                'area' => $areas,
                'brand' => $brands,
                'measure' => $measures
            );

            return $this->load->view('logistics/product/edit', $data);
        } else {
            $f = array(
                'id'      => 'p.productID',

                'estante' => 'i.shelf',
                'compart' => 'i.bin'
            );

            $t = array('table' => 'product as p');

            $j = array(
                'table_1' => 'inventory as i',
                'key_1'   => 'i.productID = p.productID'
            );

            $w = array(
                'p.productID' => $id,
                'i.locationID' => $this->session->userdata('0')->locationID
            );

            $product = $this->product_m->get($f, $t, $j, $w);
            
            $data = array('p' => $product);

            return $this->load->view('logistics/product/editar', $data);
        } 
    }

    public function update($id)
    {
        if ($this->session->userdata('0')->locationID == 1) {
            //inventory
            $shelf  = $this->input->post('mueble');
            $bin    = $this->input->post('nivel');

            $inventory = array();

            if (!empty($shelf)) {
                $inventory['shelf'] = $shelf;
            }
            if (!empty($bin)) {
                $inventory['bin'] = $bin;
            }

            // product
            $area     = $this->input->post('area');
            $brand    = $this->input->post('marca');
            $detail   = $this->input->post('detalle');
            $stockMin = $this->input->post('minimo');
            $status   = $this->input->post('estado');
            $oldimg   = $this->input->post('oldimg');

            $product = array();

            if (!empty($area)) {
                $product['areaID'] = $area;
            }
            if (!empty($brand)) {
                $product['brandID'] = $brand ;
            }
            if (!empty($detail)) {
                $product['detail'] = $detail;
            }
            if (!empty($stockMin)) {
                $product['stockMin'] = $stockMin;
            }
            if (!empty($status)) {
                $product['status'] = $status;
            }
            if (!empty($oldimg) && !empty($_FILES)) { //upload delete update

                $erase = unlink('./resources/img/logistics/product/'.$oldimg);

                if ($erase === FALSE) { 
                    echo "Image update failed, try again."; 
                    return; 
                }
                
                if ($_FILES['imagen']['name'] <> '' || $_FILES['imagen']['name'] <> null) {
                        
                    $data                    = array();
                    $config['upload_path']   = './resources/img/logistics/product/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['encrypt_name']  = true;
                    $config['max_size']      = 1024;
                        
                    $this->load->library('upload', $config);

                    if(!$this->upload->do_upload('imagen')){
                        echo $this->upload->display_errors();
                        return;
                    }

                    $data                 = $this->upload->data();
                    $product['imagePath'] = $data['file_name'];
                }
            }
            elseif (empty($oldimg) && !empty($_FILES)) {
                if ($_FILES['imagen']['error'] <> 4) { //upload update

                    if ($_FILES['imagen']['name'] <> '' || $_FILES['imagen']['name'] <> null) {
                        $data                    = array();
                        $config['upload_path']   = './resources/img/logistics/product/';
                        $config['allowed_types'] = 'jpg|png';
                        $config['encrypt_name']  = true;
                        $config['max_size']      = 1024;
                            //
                        $this->load->library('upload', $config);

                        if(!$this->upload->do_upload('imagen')){
                                echo $this->upload->display_errors();
                                return;
                        }
                        $data                 = $this->upload->data();
                        $product['imagePath'] = $data['file_name']; 
                    } 
                }
            }
            // productMeasure
            $unidad  = $this->input->post('unidad');
            $tipo    = $this->input->post('tipo');

            $t = explode(',', $tipo);

            $productM   = array();
            $productM_p = array();
            $productM_d = array();
            $i_m_p      = array(); 
            $i_m_d      = array();

            if (!empty($unidad)) {
                // 1:1 or 2:2
                if (count($t) == 1 && count($unidad) == 1) {
                    $productM['measureID'] = $unidad[0];
                }
                elseif(count($t) == 2 && count($unidad) == 2){
                    $productM_p['measureID'] = $unidad[0];
                    $productM_d['measureID'] = $unidad[1];
                }
                // 1:2 or 2:1
                if (count($t) == 1 && count($unidad) == 2) {
                    $i_m_p['measureID'] = $unidad[0];

                    $i_m_d['productID'] = $id;
                    $i_m_d['measureID'] = $unidad[1];
                    $i_m_d['type'] = 1;
                }
                elseif (count($t) == 2 && count($unidad) == 1) {
                    $i_m_p['measureID'] = $unidad[0];
                }
            }

            $where = array('productID' => $id, 'flagState' => 1);

            try {
                $this->db->trans_begin();

                if (!empty($product)) {
                    $this->product_m->update('product', $where, $product);
                }

                if (!empty($inventory)) {
                    unset($where['flagState']);
                    $where = array('locationID' => 1) + $where;
                    $this->product_m->update('inventory', $where, $inventory);
                }

                if (!empty($productM)) {
                    unset($where['flagState']);
                    $this->product_m->update('productMeasure', $where, $productM);
                }

                if (!empty($productM_p) && !empty($productM_d)) {
                    unset($where['flagState']);
                    $where = array('type' => 0) + $where;
                    $this->product_m->update('productMeasure', $where, $productM_p);
                    $where = array('type' => 1) + $where;
                    $this->product_m->update('productMeasure', $where, $productM_d);
                }

                if (!empty($i_m_p) && !empty($i_m_d)) {
                    unset($where['flagState']);
                    $where = array('type' => $tipo) + $where;
                    $this->product_m->update('productMeasure', $where, $i_m_p);
                    $this->product_m->insert('productMeasure', $i_m_d);
                }

                if (!empty($i_m_p) && empty($i_m_d)) {
                    unset($where['flagState']);
                    $where = array('type' => $t[0]) + $where;
                    $this->product_m->update('productMeasure', $where, $i_m_p);
                    $where = array('type' => $t[1]) + $where;
                    $this->product_m->delete('productMeasure', $where);
                }

                if ($this->db->trans_status() === FALSE){
                    throw new Exception('Algo salió mal, vuele a intentar.');
                }
                else{
                    $this->db->trans_commit();
                    echo $id;  
                }

            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo $e->getMessage();
            }
        } else {
            //inventory
            $shelf  = $this->input->post('mueble');
            $bin    = $this->input->post('nivel');

            $inventory = array();

            if (!empty($shelf)) {
                $inventory['shelf'] = $shelf;
            }
            if (!empty($bin)) {
                $inventory['bin'] = $bin;
            }

            $where = array('productID' => $id, 'locationID' => $this->session->userdata('0')->locationID);

            if (!empty($inventory)) {
                $r = $this->product_m->update('inventory', $where, $inventory);
                $m = ($r == 1) ? $id : 'Algo salió mal, vuele a intentar';
                echo $m;
            }
        }  
    }

    public function destroy($id)
    {
        if ($this->session->userdata('0')->locationID == 1) {

            $where  = array('productID' => $id, 'locationID' => 1);
            $state  = array('flagState' => 0);

            $stock  = $this->product_m->get('quantity', 'inventory', false, $where);

            unset($where['locationID']);

            $result = ($stock[0]->quantity <= 0) ? $this->product_m->update('product', $where, $state) : 0 ;

            echo $result;

        } else {
            /*
            if the location of the product is distinct of the almacen general
            the product is allow to be deleted because:
            -is like a new product (it's an object)
            -this must be deleted every time the product runs out 'beacause
                _they're just objects
                _como los atributos son heredados estos pueden cambiar con el tiempo
            En resume el fujo entrada y salida se controlará mejor :'v  
            */
            /* código anterior
            $where  = array('productID' => $id, 'locationID' => $this->session->userdata('0')->locationID);

            $stock  = $this->product_m->get('quantity', 'inventory', false, $where);

            $result = ($stock[0]->quantity <= 0) ? $this->product_m->delete('inventory', $where) : 0 ;

            echo $result;
            */
            // NUEVO 25/12/17
            $where  = array(
                        'productID'  => $id, 
                        'locationID' => $this->session->userdata('0')->locationID);

            $result = $this->product_m->delete('inventory', $where);

            echo $result;
        }   
    }
}
