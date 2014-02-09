<?php

class Image_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('upload');
    }
    
    public function get_category($slug='') {
        
        $slug = $this->db->escape($slug);
	$query = $this->db->query("SELECT * FROM categories WHERE slug = {$slug}  LIMIT 1 ");
	return $query->row_array();  
        
    }
    
    public function get_categories() {
      
	$query = $this->db->query("SELECT * FROM categories ORDER BY sortorder ");
	return $query->result_array();  
        
    }
   /*
    * Een functie die de aantalen plaatjes per category tergeeft
    */
   public function count_images($userid) {
       $userid = $this->db->escape($userid);
       $query = $this->db->query("SELECT categories.name,categories.category_id, count(categories.category_id) as cnt "
               . " FROM categories"
               . " LEFT JOIN images_categories ON images_categories.category_id = categories.category_id "
               . " WHERE images_categories.user_id = {$userid} "
               . " GROUP BY categories.category_id ");
        $retval = $query->result_array();
        $mygroup = array();
        $total = 0;
        foreach ( $retval as $ret){
            $mygroup[$ret['category_id']] = array('name' => $ret['name'], 'count' =>  $ret['cnt'] );
            $total = $total + $ret['cnt'];
       }
        $mygroup[0] = array('name' => 'Totaal', 'count' =>  $total );
       return  $mygroup;
   }
        
    public function get_my_images($userid, $category_id ='', $image_stat = '', $limit = 25, $start= 0 ) {
        
        $userid = $this->db->escape($userid);
        $and ='';
        if (!empty($image_stat)){
            $image_stat = $this->db->escape($image_stat);
            $and =  "AND image_stat = {$image_stat}";
        }
        if (empty($category_id)){     
            $query = $this->db->query("SELECT * FROM images"
                    . " WHERE user_id = {$userid}"
                    . " {$and}"
                    . " ORDER BY sortorder"
                    . " LIMIT {$limit}"
                    . " OFFSET {$start}");
        } else {
            $category_id = $this->db->escape($category_id);
            $query = $this->db->query("SELECT * FROM images "
                    . " LEFT JOIN images_categories "
                    . " ON images_categories.image_id = images.image_id"
                    . " WHERE images.user_id = {$userid} "
                    . " AND images_categories.category_id = {$category_id}"
                    . " ORDER BY images_categories.sortorder "
                    . " LIMIT {$limit}"
                    . " OFFSET {$start}");
        }
	return $query->result_array();  
        
    }
    public function get_my_image($userid, $imageid) {
        
        $userid = $this->db->escape($userid);
        $imageid = $this->db->escape($imageid);
         $query = $this->db->query("SELECT images.*,images_categories.category_id FROM images"
                    . " LEFT JOIN images_categories "
                    . " ON images_categories.image_id = images.image_id"
                    . " WHERE images.user_id = {$userid} "
                    . " AND images.image_id = {$imageid}"
                    . " LIMIT 1 ");
   
	return $query->row_array();  
        
    }
    
    public function delete_my_image($userid, $imageid) {
        
        if ( (!empty($userid)) && (!empty($imageid)) ) { 
            $this->db->delete('images', array('user_id' => $userid, 'image_id' => $imageid  )); 
            $this->db->delete('images_categories', array('user_id' => $userid, 'image_id' => $imageid  )); 
            $this->db->delete('images_tags', array('user_id' => $userid, 'image_id' => $imageid  )); 
            return TRUE;
        } 
        return FALSE;
       
    }
    public function update_sort($ids, $user_id, $category_id ='' ) {
    
       foreach($ids as $index=>$id) {
            $id = (int) $id;
            if($id != '') {
                $data_image = array(
                    'sortorder' => $index + 1
                );
                if (empty($category_id)){
                    $this->db->update('images', $data_image, array('image_id' => $id, 'user_id' => $user_id ));
                   } else {
                    $this->db->update('images_categories', $data_image, array('image_id' => $id, 'user_id' => $user_id, 'category_id' => $category_id ));
                }
            }
	}
        exit;
     }
    public function update(array $data) {

        if (array_key_exists('image_id', $data)) {

            $this->db->trans_begin();

            // check of er geen verkeerde kolommen meekomen
            $data_image = $this->_filter_data('images', $data);
            $this->db->update('images', $data_image, array('image_id' => $data['image_id']));
            
            // relaties met categorie updaten, anders aanmaken.
            if ( $data['org-category_id'] != $data['category_id'])  { 
                $this->db->update('images_categories', array('category_id' => $data['category_id']),  array('image_id' => $data['image_id'], 'user_id' => $data['user_id'] ));           

                 $retval = $this->db->affected_rows();
                 if ($this->db->affected_rows() === 0){
                      $data_category = $this->_filter_data('images_categories', $data);
                      $this->db->insert('images_categories', $data_category);
                  }
            }  
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
               return array('txt' => $this->config->item('fail_save'), 'status' => '0');
            }
            $this->db->trans_commit();
            return array('txt' => $this->config->item('ok_save'), 'status' => '1');
        } else {
            return array('txt' => $this->config->item('fail_save'), 'status' => '0');
        }
    }

    public function create(array $data) {

        $this->db->trans_begin();
       
        $data_image = $this->_filter_data('images', $data);
        $this->db->insert('images', $data_image);
        $id = $this->db->insert_id();
        $data_category = array(
            'image_id' => $id,
            'user_id' => $data_image['user_id'],
            'category_id' => '99'
        );
         $this->db->insert('images_categories', $data_category);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array('txt' => $this->config->item('fail_save'), 'status' => '0');
        }
        $this->db->trans_commit();
        return array('id' => $id, 'txt' => $this->config->item('ok_save'), 'status' => '1');
    }

    function delete($id = 0) {
        $this->db->where('id', $id);
        $affected_rows = $this->db->delete('seopage');
        return $affected_rows;
    }

    protected function _filter_data($table, $data) {
        $filtered_data = array();
        $columns = $this->db->list_fields($table);
        if (is_array($data)) {
            foreach ($columns as $column) {
                if (array_key_exists($column, $data)) {
                    $filtered_data[$column] = $data[$column];
                }
            }
        }

        return $filtered_data;
    }

}
