<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Afbeeldingen extends CI_Controller {

    private $data;

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->lang->load('auth');
        $this->load->helper(array('form'));
        $this->data['loggedin'] = $this->ion_auth->logged_in();
        $this->data['isadmin'] = $this->ion_auth->is_admin();
        if ($this->data['loggedin']) {
            $this->data['user'] = $this->ion_auth->user()->row_array();
        }
    }

    function index() {
        if (!$this->data['loggedin']) {
            redirect('/inloggen', 'refresh');
        }
        $this->_render_page('templates/profile', $this->data);
    }

    function my_images($category_slug='alles') {
        
        if (!$this->data['loggedin']) {
            redirect('/inloggen', 'refresh');
        }
           
        $category_id = '';
        $image_status = '';
        $count_cat =0;
        
        if ((!empty($category_slug)) && ($category_slug != 'alles') ){
            $this->data['category_data'] = $this->image_model->get_category($category_slug);
            $category_id = $this->data['category_data']['category_id'];
            $count_cat = $category_id;
        }
        $this->data['categories'] = $this->image_model->get_categories();

        $this->data['css_files'] = array(
            '/css/smoothness/jquery-ui-1.10.4.custom.min.css'
        );
        $this->data['js_files'] = array(
            '/js/jquery-ui-1.10.4.custom.min.js',
            '/js/custom.js'
        );
        
        $this->data['image_count'] = $this->image_model->count_images($this->data['user']['id']);
        $totalrows = 0;
        if (isset($this->data['image_count'][$count_cat]['count'])){
            $totalrows =$this->data['image_count'][$count_cat]['count'];
        }
        
        // paging...
        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = base_url() . "mijn-fotos/".$category_slug;
        $config["total_rows"] = $totalrows;
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                
        
        $this->data['images'] = $this->image_model->get_my_images($this->data['user']['id'],$category_id, $image_status,$config["per_page"],$page);
        $this->data['links'] = $this->pagination->create_links();
       
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->_render_page('templates/profile_my_images', $this->data);
    }

    function store_sort() {

        if (!$this->ion_auth->logged_in()) {
            redirect('inloggen', 'refresh');
        }
        $category_id = '';
        if ($this->input->get('category_id', TRUE)) {
            $category_id = $this->input->get('category_id', TRUE);
        }
        if ($this->input->get('sort_order', TRUE)) {
            /* split the value of the sortation */
            $ids = explode(',', $this->input->get('sort_order', TRUE));
            
            
            $retval = $this->image_model->update_sort($ids, $this->data['user']['id'], $category_id);
        }
    }

    function do_upload() {

        if (!$this->ion_auth->logged_in()) {
            redirect('inloggen', 'refresh');
        }

        //$verifyToken = md5('imageposting_salt' . $_POST['timestamp']);
        //if (!empty($_FILES) && $_POST['token'] == $verifyToken) {

        $this->load->library('upload');

        $image_upload_folder = FCPATH . '/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path' => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg',
            'max_size' => 20000,
            'remove_space' => TRUE,
            'encrypt_name' => TRUE,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            echo json_encode($upload_error);
        } else {
            $file_info = $this->upload->data();
            echo json_encode($file_info);
            $file_info['user_id'] = $this->data['user']['id'];
            $file_info['image_stat'] = '1';
            $this->image_model->create($file_info);
        }
      
        // }
    }

    function new_image() {

        if (!$this->ion_auth->logged_in()) {
            redirect('inloggen', 'refresh');
        }
        $this->data['message'] = validation_errors();
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['css_files'] = array(
            '/css/uploadifive.css'
        );
        $this->data['js_files'] = array(
            '/js/jquery.uploadifive.min.js'
        );
        $this->_render_page('/templates/profile_image_add', $this->data);

    }

    function edit_image($id) {

        if (!$this->ion_auth->logged_in()) {
            redirect('inloggen', 'refresh');
        }

        $this->data['categories'] = $this->image_model->get_categories();

        $this->data['image'] = $this->image_model->get_my_image($this->data['user']['id'], $id);
        // je mag alleen je eigen objecten aanpassen
        if ($this->data['image']['user_id'] != $this->data['user']['id']) {
            //redirect('inloggen', 'refresh');
        }
        $this->form_validation->set_rules('title', 'Een titel voor de afbeelding', 'required|xss_clean');
        $this->form_validation->set_rules('category_id', 'Een categorie voor de afbeelding', 'required|xss_clean');
        if ($this->form_validation->run() == true) {
            $image_data = array(
                'image_id' => $id,
                'user_id' => $this->data['user']['id'],
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'category_id' => $this->input->post('category_id'),
                'org-category_id' => $this->data['image']['category_id'],
                'image_stat' => 2
            );
            $retval = $this->image_model->update($image_data);
            
            
        } else {
            // $this->data['image'] = $this->security->xss_clean($this->input->post());
            if ($this->data['image']['image_id']) {
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->load->view('/templates/forms/image_popup', $this->data);
            } else {
                return false;
            }
        }
    }
    
    function delete_image(){
        if (!$this->ion_auth->logged_in()) {
            redirect('inloggen', 'refresh');
        }
        $id = $this->input->post('image_id', 'TRUE');
        $slug = $this->input->post('category_path', 'TRUE');
        $this->data['image'] = $this->image_model->get_my_image($this->data['user']['id'], $id);
               
        if ( ( $this->_valid_csrf_nonce()) && (!empty($this->data['image']['image_id']))){
            $this->image_model->delete_my_image($this->data['user']['id'], $this->data['image']['image_id']);
         
        } 
         redirect('mijn-fotos/'.$slug, 'refresh');
    }
    
    
    private function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    private function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;
        $this->viewdata['view_main'] = $view;

        $view_html = $this->load->view('html', $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

}
