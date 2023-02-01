


    link download 

    -> code igniter 3  = https://codeigniter.com/download  

    -> github rest api  = https://github.com/stevi-ema/rest_api

    - JWT encode dan decode  = https://jwt.io/


                        ------>>>    CODING    <<<---------
<?php
                                                         //controller matakuliah
    <?php  
 
    defined('BASEPATH') or exit('No direct script access allowed'); 
    require APPPATH . 'libraries/REST_Controller.php'; 
     
    class Matakuliah extends REST_Controller { 
        //constructor 
        function _construct() {
        parent::__construct();
        $this->load->database(); 
        }
    
     
    //merupakan data matakuliah
    function index_get(){ 
        $id = $this->get('kode_mk'); 
        if($id == ''){ 
            $matakuliah = $this->db->get('matakuliah')->result();
        }else{ 
            $this->db->where('kode_mk',$id); 
            $matakuliah = $this->db->get('matakuliah')->result();
        } 
        $this->response($matakuliah, REST_Controller::HTTP_OK);
    } 
     
    //merupakan tambah data matakuliah
    function index_post(){ 
        $data = array( 
            'kode_mk' => $this->post('kode_mk'), 
            'nama' => $this->post('nama'),
            'semester' => $this->post('semester'),
            'sks' => $this->post('sks'),
            'sifat' => $this->post('sifat')); 
             
            $insert = $this->db->insert('matakuliah', $data); 
             
            if($insert){ 
                $this->response($data, REST_Controller::HTTP_OK);
            }else{ 
                $this->response(array('status' => 'fail', 502));
            }
    } 
     
    //merupakan update data matakuliah
    function index_put(){ 
         $id = $this->put('kode_mk'); 
         $data = array( 
            'kode_mk' => $this->put('kode_mk'), 
            'nama' => $this->put('nama'),
            'semester' => $this->put('semester'),
            'sks' => $this->put('sks'),
            'sifat' => $this->put('sifat') 
        );  

        $this->db->where('kode_mk', $id); 
        $update = $this->db->update('matakuliah', $data); 
         
        if($update){ 
            $this->response($data, REST_Controller::HTTP_OK); 
        }else{ 
            $this->response(array('status' => 'fail', 502));
        }
         
    } 
 
     
     
    //merupakan hapus data mahasiswa  
    function index_delete(){ 
        $id = $this->delete('kode_mk'); 
        $this->db->where('kode_mk', $id); 
        $delete = $this->db->delete('matakuliah'); 
         
        if($delete){  
            $this->response(array('status'=> 'success', 2011)); 
        }else{ 
            $this->response(array('status' => 'fail', 502));
        }
    }
 
 
}






                                    //CONTROLLER OTENTIKASI



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





                                        // MODEL -> OTENTIKASI MODEL

<?php
class OtentikasiModel extends CI_Model{

    function check_login($email, $password){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email',$email);
        $this->db->where('password', $password);
        //$this->db->status('status',0);

        $query = $this->db->get();
        
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return "Pengguna tidak dituemukan ! ";
        }
    }

}
                                        
                                        
