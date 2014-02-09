<?php

class Admincms extends CI_Controller {

        /*
         * Deze admin controller maakt gebruik van de grocery CRUD:
         * http://www.grocerycrud.com/documentation/
         * hiermee kan je snel een backend opzetten om je site te vullen
         * en bij te houden.
         * Deze crud is niet geschikt voor frontend user interactie.
         * sommige admin functies kunnen ook niet gedaan worden door deze crud,
         * daarvoor word een custom controller gebruikt. (TODO)
         */
    
        private $data;
    
    	public function __construct()
	{
		parent::__construct();

		$this->load->database();
                $this->lang->load('auth');
                $this->load->library('grocery_CRUD');
                $this->load->helper(array('form', 'language'));
                $this->data['loggedin'] = $this->ion_auth->logged_in();
                $this->data['isadmin'] = $this->ion_auth->is_admin();
                if (! $this->data['isadmin']){
                    redirect('/');
                }
	}
        /*
         * 
         */
        private function _admin_output($output = null)
	{
		$this->load->view('admin/index.php',$output);
	}        
       
        public function index()
	{
		$this->_admin_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

        
       public function users($operation = '') {
        
            $crud = new grocery_CRUD();
            //FORM LAYOUT
            $crud->set_subject('Users');
            $crud->columns('first_name','last_name', 'email','last_login','active');
            $crud->display_as('first_name', 'Voornaam')
            ->display_as('last_name', 'Achternaam')
            ->display_as('username', 'Gebruikersnaam')       
            ->display_as('password', 'Wachtwoord')
            ->display_as('password_confirm', 'Wachtwoord bevestiging')
            ->display_as('last_login', 'Laatst ingelogd');

            $crud->add_fields('active','first_name', 'last_name', 'email', 'username','password', 'password_confirm','gender','iban_number');
            //$crud->edit_fields('active', 'first_name', 'last_name', 'username', 'email','gender','iban_number','grouplist' );

            //$crud->field_type('active','enum',array('active','inactive'));
            
            $crud->set_relation_n_n('grouplist', 'users_groups', 'groups', 'user_id', 'group_id', 'name');
                 
            $crud->field_type('active','dropdown',
                                array( "1"  => "Active", "2" => "Inactive"));
            $crud->field_type('gender','dropdown',
                                array( "m"  => "Man", "v" => "Vrouw"));
            //VALIDATION
            $crud->required_fields('active','first_name', 'last_name', 'email', 'password', 'password_confirm');
            $crud->set_rules('email', 'E-mail', 'required|valid_email');
            $crud->set_rules('password', 'Wachtwoord', 'required|matches[password_confirm]');

            //FIELD TYPES
            $crud->field_type('password', 'password');
            $crud->field_type('password_confirm', 'password');
            $crud->field_type('last_login', 'unixtimestamp');
           
            //CALLBACKS
            $crud->callback_insert(array($this, 'create_user_callback'));
            $crud->callback_delete(array($this, 'delete_user'));

            $output = $crud->render();
            $this->_admin_output($output);
      }
      
      public function categories() {
          
            $crud = new grocery_CRUD();
            $crud->set_table('categories');
            $crud->set_subject('Category');
            $crud->required_fields('name');
            $crud->columns('name','description');
            $output = $crud->render();
            $this->_admin_output($output);

     }
    public  function collections() {
          
            $crud = new grocery_CRUD();
            $crud->set_table('collections');
            $crud->set_subject('Collection');
            $crud->required_fields('name');
            $crud->columns('name','description');
            $output = $crud->render();
            $this->_admin_output($output);

     }
    public function images() {
          
            $crud = new grocery_CRUD();
            $crud->set_table('images');
            $crud->set_subject('Images');
            $crud->columns('name','Naam', 'email', 'username','last_login','grouplist','active');
            $crud->display_as('first_name', 'Voornaam')
            ->display_as('last_name', 'Achternaam')
            ->display_as('username', 'Gebruikersnaam')       
            ->display_as('password', 'Wachtwoord')
            ->display_as('password_confirm', 'Wachtwoord bevestiging')
            ->display_as('last_login', 'Laatst ingelogd');
            $crud->required_fields('name');
            $crud->columns('name','description');
            $crud->set_relation_n_n('categorylist', 'images_categories', 'categories', 'image_id', 'category_id', 'name');
            $crud->set_relation_n_n('collectionslist', 'images_collections', 'collections', 'image_id', 'collection_id', 'name');
            $output = $crud->render();
            $this->_admin_output($output);

     } 
      
     //CALLBACKS 
    public function delete_user($primary_key) {

        if ($this->ion_auth_model->delete_user($primary_key)) {
            return true;
        } else {
            return false;
        }
    }

    public  function create_user_callback($post_array, $primary_key = null) {

        $username = $post_array['first_name'] . ' ' . $post_array['last_name'];
        $password = $post_array['password'];
        $email = $post_array['email'];
        $data = array(
                    'first_name' => $post_array['first_name'],
                    'last_name' => $post_array['last_name']
                    );

        $this->ion_auth_model->register($username, $password, $email, $data);
    
    return $this->db->insert_id();
    }
    
}