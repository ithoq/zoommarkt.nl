<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
	
    } 

    
    public function index()
    {
        if ($this->ion_auth->logged_in() )
        {
           $this->data['user'] = $this->ion_auth->user()->row_array();
        }
        $this->load->view('homepage',$this->data );
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */