<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of restclient
 *
 * @author Casper
 */
class Restclient extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */
    
    private $data; 
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	$this->lang->load('auth');
	$this->load->helper(array('form', 'url', 'language'));
	$this->data['loggedin'] = $this->ion_auth->logged_in();
	$this->data['isadmin'] = $this->ion_auth->is_admin();
	$this->load->library('rest');
        $config  = array('server'  => 'http://puppygifs.net/',
                //'api_key'         => 'Setec_Astronomy'
                //'api_name'        => 'X-API-KEY'
                //'http_user'       => 'username',
                //'http_pass'       => 'password',
                //'http_auth'       => 'basic',
                //'ssl_verify_peer' => TRUE,
                //'ssl_cainfo'      => '/certs/cert.pem'
                );
         $this->rest->initialize($config);
    } 

    
    public function index()
    {
        $tumblr = $this->rest->get('api/read/json');
        var_dump($tumblr);
      
    }
}