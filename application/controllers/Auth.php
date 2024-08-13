<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function register() {
        $data['form_action'] = site_url('auth/register_user');
        $this->load->view('register', $data);
    }

    public function register_user() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = site_url('auth/register_user');
            $this->load->view('register', $data);
        } else {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '2048'; 

            $this->upload->initialize($config);

            if ($this->upload->do_upload('profile_picture')) {
                $uploadData = $this->upload->data();
                $profile_picture = $uploadData['file_name'];
            } else {
                $profile_picture = '';
            }

            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),  
                'profile_picture' => $profile_picture
            );

            $this->User_model->insert_user($data);

            redirect('auth/login');
        }
    }

    public function login() {
        $this->load->view('login');
    }

    public function login_user() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->login($email, $password);

        if ($user) {
            $session_data = [
                'user_id' => $user->id,
                'name' => $user->name,
                'profile_picture' => $user->profile_picture,
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($session_data);
            redirect('auth/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid Email or Password');
            redirect('auth/login');
        }
    }

    public function dashboard() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $data['name'] = $this->session->userdata('name');
        $data['profile_picture'] = $this->session->userdata('profile_picture');

        $this->load->view('dashboard', $data);
    }

    public function logout() {
        $this->session->unset_userdata(['user_id', 'name', 'profile_picture', 'logged_in']);
        redirect('auth/login');
    }

    public function profile() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->User_model->get_user_by_id($user_id);  

        $this->load->view('profile', $data);
    }

    public function update_profile() {
        $user_id = $this->session->userdata('user_id');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $this->profile();
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email')
            ];

            if (!empty($this->input->post('password'))) {
                $data['password'] = $this->input->post('password');  
            }

            if (!empty($_FILES['profile_picture']['name'])) {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $this->upload->initialize($config);

                if ($this->upload->do_upload('profile_picture')) {
                    $upload_data = $this->upload->data();
                    $data['profile_picture'] = $upload_data['file_name'];

                    $this->session->set_userdata('profile_picture', $data['profile_picture']);
                }
            }

            $this->User_model->update_user($user_id, $data);
            redirect('auth/dashboard');
        }
    }

    public function search() {
        $this->load->view('search');  // Load the search page initially
    }
    
    public function search_results() {
        $query = $this->input->post('query');
        $api_key = '45416105-2cf62fab42555ca56ce1d352b';
        $url = "https://pixabay.com/api/?key=$api_key&q=" . urlencode($query) . "&image_type=photo";
    
        $response = file_get_contents($url);
        $data = json_decode($response, true);
    
        if (isset($data['hits']) && is_array($data['hits'])) {
            $results = $data['hits'];
        } else {
            $results = [];
        }
    
        $data['results'] = $results;
        $this->load->view('search', $data);
    }    
}
