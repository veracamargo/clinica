<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cidade extends CI_Controller {

    /**
     * @author Vitor Hugo Bassetto <vitorhugobassetto@gmail.com>
     * 
     */
    public function index() {

        if (!$this->sis_login->_isLogado()) {
            redirect(site_url("/login"));
        } else {
            $data['usuario'] = $this->session->userdata;
        }
        
        $this->load->model('Grocery_crud_model');
//        $data=array('output' => '' , 'js_files' => array() , 'css_files' => array());
        $data['titulo'] = "Cidades";
        $data['admin_name'] = "Cidades";


        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('cidades');
            $crud->set_subject('Cidades');
            $crud->required_fields('cep', 'nome');
            $crud->columns('nome', 'cep');
            $crud->order_by('nome');
//            $crud->fields('nome');
//            $crud->edit_fields('nome');

            $data['crud'] = $crud->render();
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }

        $this->load->view('layouts/layout', $data);
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */
    