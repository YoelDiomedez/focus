<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kardex extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/kardex_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
        $fi = array(
            'productID' => 'p.productID',
            'inputs'    => 'sum(d.quantity) as inputQ',
            'detalle'   => 'p.detail',
            'stockmin'  => 'p.stockMin'

        );

        $ti = array('table' => 'product as p');

        $ji = array(
            'table_1' => 'inputdetail as d',
            'key_1'   => 'd.productID = p.productID',
            'table_2' => 'input as i',
            'key_2'   => 'i.inputID = d.inputID'
        );

        $wi = array('i.status' => 1, 'p.flagstate' => 1);

        $gi = array('product' => 'p.productID');

        $inputs = $this->kardex_m->get($fi, $ti, $ji, $wi, $gi);

        $fo = array(
            'productID' => 'p.productID',
            'outputs'   => 'sum(d.quantity) as outputQ',

        );

        $to = array('table' => 'product as p');

        $jo = array(
            'table_1' => 'outputdetail as d',
            'key_1'   => 'd.productID = p.productID',
            'table_2' => 'output as i',
            'key_2'   => 'i.outputID = d.outputID'
        );

        $wo = array('i.status' => 1);

        $go = array('product' => 'p.productID');

        $outputs = $this->kardex_m->get($fo, $to, $jo, $wo, $go);

        $data = array('input' => $inputs, 'output' => $outputs);

        return $this->load->view('logistics/kardex/index', $data);
    }

    public function show($id)
    {
        $product = array(
            'fields' => array('id' => 'productID', 'nombre' => 'detail', 'estado' => 'status'),
            'table'  => array('table' => 'product'), 
            'where'  => array('flagstate' => 1, 'productID' => $id)
        );

        $p = $this->kardex_m->get($product['fields'], $product['table'], false, $product['where']);

        $inputs1 = "
            select 'Compra' as detalle, product.productID, product.detail, input.status, input.date, 
            inputdetail.quantity, inputdetail.unitPrice
            from product
            join inputdetail
            on inputdetail.productID = product.productID
            join input
            on input.inputID = inputdetail.inputID
            where product.productID = ".$id." and product.flagState = 1
            group by product.productID, inputdetail.inputDetailID
        ";

        $inputs0 = "
            select 'Compra Dev' as detalle, product.productID, product.detail, input.status, input.date, 
            inputdetail.quantity, inputdetail.unitPrice
            from product
            join inputdetail
            on inputdetail.productID = product.productID
            join input
            on input.inputID = inputdetail.inputID
            where product.productID = ".$id." and product.flagState = 1 and input.status = 0
            group by product.productID, inputdetail.inputDetailID
        ";

        $outputs1 = "
            select 'Distribucion', product.productID, product.detail, output.status, output.date, 
            outputdetail.quantity, outputdetail.unitPrice
            from product
            join outputdetail
            on outputdetail.productID = product.productID
            join output
            on output.outputID = outputdetail.outputID
            where product.productID = ".$id." and product.flagState = 1
            group by product.productID, outputdetail.outputdetailID
        ";

        $outputs0 = "
            select 'Distribucion Dev', product.productID, product.detail, output.status, output.date, 
            outputdetail.quantity, outputdetail.unitPrice
            from product
            join outputdetail
            on outputdetail.productID = product.productID
            join output
            on output.outputID = outputdetail.outputID
            where product.productID = ".$id." and product.flagState = 1 and output.status = 0
            group by product.productID, outputdetail.outputDetailID

            ORDER BY 5 ASC
        ";

        $k = $this->kardex_m->query($inputs1.' UNION '.$inputs0.' UNION '.$outputs1.' UNION '.$outputs0);

        foreach ($k as $key => $value) {
            if ($value->status == 0 && $value->detalle == 'Compra') {
                $value->status = 1;
            }
            if ($value->status == 0 && $value->detalle == 'Distribucion') {
                $value->status = 1;
            }
        }

        $SQ  = 0;
        $SCU = 0;
        $SCT = 0;

        for ($i=0; $i < count($k); $i++) {

            if ($k[$i]->status == 1 && $k[$i]->detalle == 'Compra') {

                $k[$i]->total = $k[$i]->quantity * $k[$i]->unitPrice;

                $SQ  = $SQ + $k[$i]->quantity;
                $SCT = $SCT + $k[$i]->total;
                $SCU = $SCT / $SQ;

                $k[$i]->SaldoQ  = $SQ;
                $k[$i]->SaldoCU = $SCU;
                $k[$i]->SaldoCT = $SCT;

            }
            if ($k[$i]->status == 0 && $k[$i]->detalle == 'Compra Dev') {

                $k[$i]->total = $k[$i]->quantity * $k[$i]->unitPrice;

                $SQ  = $SQ - $k[$i]->quantity;
                $SCT = $SCT - $k[$i]->total;
                $SCU = @($SCT / $SQ);

                $SCU = ($SCU == false) ? 0 : $SCU;

                $k[$i]->SaldoQ  = $SQ;
                $k[$i]->SaldoCU = $SCU;
                $k[$i]->SaldoCT = $SCT;

            }

            if ($k[$i]->status == 1 && $k[$i]->detalle == 'Distribucion') {

                $k[$i]->total = $k[$i]->quantity * $SCU;

                $SQ  = $SQ - $k[$i]->quantity;
                $SCT = $SCT - $k[$i]->total;
                $SCU = @($SCT / $SQ);

                $SCU = ($SCU == false) ?  $k[$i]->total / $k[$i]->quantity : $SCU;

                $k[$i]->SaldoQ  = $SQ;
                $k[$i]->SaldoCU = $SCU;
                $k[$i]->SaldoCT = $SCT;

            }
            if ($k[$i]->status == 0 && $k[$i]->detalle == 'Distribucion Dev') {

                $k[$i]->total = $k[$i]->quantity * $SCU;

                $SQ  = $SQ + $k[$i]->quantity;
                $SCT = $SCT + $k[$i]->total;
                $SCU = $SCT / $SQ;

                $k[$i]->SaldoQ  = $SQ;
                $k[$i]->SaldoCU = $SCU;
                $k[$i]->SaldoCT = $SCT;
            }

        }
        
        $data = array('product' => $p, 'kardex' => $k);

        return $this->load->view('logistics/kardex/show', $data);
    }
}