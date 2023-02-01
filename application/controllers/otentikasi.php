<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//constructor
class otentikasi extends CI_Controller{


    public function __construct(){
        parent::__construct();
        $this->load->model('OtentikasiModel');
    }

//Authorization
    public function login(){
        $jwt = new JWT();
        $jwtSecretKey = 'Secretkeycontohrestadam';
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $result = $this->OtentikasiModel->check_login($email, $password);
        $token = $jwt->encode($result, $jwtSecretKey, 'HS256');
        echo json_encode($token);
    }


    public function index(){
        echo 'Otentikasi';
    }

    /*
    public function token(){
        $jwt = new JWT();

        $jwtSecretKey ='Secretkeycontohrestadam';
        $data = array(
            'userId' => 1,
            'email' => 'adamarnap@yahoo.com',
            'userType' => 'admin',
        );

        $token =$jwt->encode($data, $jwtSecretKey,'HS256');
        echo $token;
    }

    public function decode_token(){
        $token =$this->uri->segment(3);
        $jwt = new JWT();
        $jwtSecretKey = 'Secretkeycontohrestadam';
        $decoce_token = $jwt->decode($token, $jwtSecretKey, 'hs256');
        $token1 = $jwt->jsonEncode($decoce_token);
        echo $token1;
    }
    */
}