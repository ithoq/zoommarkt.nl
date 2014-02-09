<?php 
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
class Crud extends CI_Controller {
	public function index() { 
		$this->load->add_package_path ( APPPATH . 'third_party/codeignitercrud/' );
		$this->load->library ( 'CodeigniterCrud' );
		
		$this->codeignitercrud->table ( 'users' );

		$this->codeignitercrud->tableAlias ( 'User Manager' );
		
		$this->codeignitercrud->addNoCol ( true );
		$this->codeignitercrud->disabled ( array(   'username',
                                                            'password',
                                                            'last_login',
                                                            'ip_address',
                                                            'activation_code',
                                                            'salt',
                                                            'forgotten_password_code',
                                                            'forgotten_password_time', 
                                                            'remember_code','created_on') );
                $this->codeignitercrud->hideCol ( array(   'username',
                                                            'password',
                                                            'ip_address',
                                                            'activation_code',
                                                            'salt',
                                                            'company',
                                                            'phone',
                                                            'forgotten_password_code',
                                                            'forgotten_password_time', 
                                                            'remember_code',
                                                            'groups.id',
                                                            'users_groups.id',
                                                            'users_groups.user_id',
                                                            'users_groups.group_id', 
                                                            'groups.name'
                    
                    ) );
		$this->codeignitercrud->alias ( 'email', 'Email' )
                                        ->alias ( 'first_name', 'Voornaam' )
                                        ->alias ( 'last_name', 'Achternaam' )
                                        ->alias ( 'company', 'Bedrijfsnaam' )
                                        ->alias ( 'phone', 'telefoon' )
                                        ->alias ( 'active', 'Actief' );
	
                $this->codeignitercrud->type ( 'active', 'radio', array (
                                                                    'Inactief', 'Actief'),
                                                                   array (
                                                                    'value' => 1 // default value
                                                                         ) );
               
                $this->codeignitercrud->join ( 'left', 'users_groups', 'users.id = users_groups.user_id' );
                $this->codeignitercrud->join ( 'left', 'groups', 'users_groups.group_id = groups.id' );
                
                $this->codeignitercrud->group('users.id');
                
		$this->codeignitercrud->search (  array(   'email','first_name', 'last_name', 'phone','active') );
		
		$html = $this->codeignitercrud->fetch ();
		
		$this->load->view ( 'example1', array (	'html' => $html	) );
	}
} 