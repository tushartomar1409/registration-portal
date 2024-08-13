<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_id($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row(); 
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows() === 1) {
            $user = $query->row();
            if ($password == $user->password) { 
                return $user;
            }
        }
        return FALSE;
    }
}
