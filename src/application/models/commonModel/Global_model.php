<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Global_Model extends CI_Model {
    public $db_link;	 

    function __construct() {
        parent ::__construct();	

        $properties = get_object_vars($this->db);

        $this->db_link = $properties['conn_id'];
    } 
}
?>
