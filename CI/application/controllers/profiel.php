<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profiel extends CI_Controller {

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
        $this->data['image_count'] = $this->image_model->count_images($this->data['user']['id']);
        $this->_render_page('templates/profile', $this->data);
    }


    function new_profile() {

        if ($this->ion_auth->logged_in()) {
            redirect('aanpassen', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
        $this->form_validation->set_rules('iban_number', $this->lang->line('create_user_validation_iban_number_label'), 'required|xss_clean');

        if ($this->form_validation->run() == true) {
            
            $username = strtolower($this->input->post('first_name')) . '-' . strtolower($this->input->post('last_name'));
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'gender' => $this->input->post('gender'),
                'iban_number' => $this->input->post('iban_number'),
                'phone' => $this->input->post('phone'),
                'description' => $this->input->post('description'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'weburl' => $this->input->post('weburl'),
                'blogurl' => $this->input->post('blogurl'),
                'twitterurl' => $this->input->post('twitterurl'),
                'facebookurl' => $this->input->post('facebookurl')
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data)) {

            $this->data['message'] = "Er is een activatielink per mail verstuurd.";
            $this->_render_page('/templates/homepage', $this->data);
        } else {

            $rs = $this->security->xss_clean($this->input->post());

            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            if ((validation_errors() || $this->ion_auth->errors())) {
                $this->data['account'] = $rs;
            }

            $this->data['csrf'] = $this->_get_csrf_nonce();

            $this->_render_page('templates/profile_add', $this->data);
        }
    }

    function edit_profile() {

        $this->data['title'] = "Profiel bewerken";

        if (!$this->ion_auth->logged_in()) {
            redirect('auth', 'refresh');
        }

        // haal de huidig ingelogde gebruiker op.
        $user['password'] = '';
        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        $this->form_validation->set_rules('iban_number', $this->lang->line('create_user_validation_iban_number_label'), 'required|xss_clean');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE) {
                show_error($this->lang->line('error_csrf'));
            }

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'gender' => $this->input->post('gender'),
                'iban_number' => $this->input->post('iban_number'),
                'phone' => $this->input->post('phone'),
                'description' => $this->input->post('description'),
                'date_of_birth' => $this->input->post('date_of_birth'),
                'weburl' => $this->input->post('weburl'),
                'blogurl' => $this->input->post('blogurl'),
                'twitterurl' => $this->input->post('twitterurl'),
                'facebookurl' => $this->input->post('facebookurl'),
                'zoom_id' => $this->input->post('zoom_id'),
                'zoom_username' => $this->input->post('zoom_username'),
            );

            //update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
                $data['password'] = $this->input->post('password');
            }

            if ($this->form_validation->run() === TRUE) {
                $this->ion_auth->update($this->data['user']['id'], $data);
                //redirect them back to the profile page
                $this->session->set_flashdata('message', "User Saved");
                redirect("/profiel", 'refresh');
            }
        }

        //display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view

        $this->data['account'] = $this->data['user'];

        $this->_render_page('templates/profile_edit', $this->data);
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
