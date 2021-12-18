<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require __DIR__ . '/../../vendor/autoload.php';
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends CI_Controller {

	public $key = "123456";

	public function index()
	{
		$this->load->view('coba');
	}

	public function post_auth()
	{
		$username = "danuandrean";
		$jwt = $this->input->get_request_header('Authorization');
        try {
            $decode = JWT::decode($jwt,$this->key,array('HS256'));
            if ($decode == $username ) {
				return $this->output
				->set_content_type('application/json')
				->set_status_header(500)
				->set_output(json_encode(array(
						'status' => 'succes',
						'decode' => $decode
				)));
            }
        } catch (Exception $e) {
            exit('Wrong Token');
        }
	}
	public function token()
    {
		$username = "danuandrean";

		$jwt = JWT::encode($username, $this->key, 'HS256');
		$decoded = JWT::decode($jwt, new Key($this->key, 'HS256'));
		// echo json_encode( $jwt );
		// print_r($decoded);
		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode(array(
                    'token' => $jwt,
                    'decode' => $decoded
            )));
      
    }
}


