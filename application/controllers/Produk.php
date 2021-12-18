
<?php
// simple crud
// semua fungsi dibawah dibuat oleh ci
// jika diubah maka akan error, sebaiknya dilakukan dirouter

use chriskacerguis\RestServer\RestController;
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends RestController
{
    public function __construct()
    {
        parent::__construct();
        //inisialisasi model Produk_model.php dengan nama produk
        $this->load->model('Produk_model', 'produk');
        // $this->load->database(); //tidak perlu membuat model
    }
    public function index_get()
    {
       $id = $this->get('id');
        if ($id == '') {
            $produk = $this->db->get('produk')->result();
        } else {
            $this->db->where('id', $id);
            $produk = $this->db->get('produk')->result();
        }
        $this->response($produk, RestController::HTTP_OK);
    }
    public function index_post()
    {
        $data = array(
            'nama_produk'        => $this->post('nama_produk'),
            'tipe_produk'        => $this->post('tipe_produk'),
            'stok'               => $this->post('stok'),
            'harga'              => $this->post('harga'),
        );
        $insert = $this->db->insert('produk', $data);
        if ($insert) {
            $this->response($data, RestController::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    public function index_put() {
        $id = $this->put('id');
        $data = array(
            'nama_produk'        => $this->put('nama_produk'),
            'tipe_produk'        => $this->put('tipe_produk'),
            'stok'               => $this->put('stok'),
            'harga'              => $this->put('harga'),
        );
        $this->db->where('id', $id);
        $update = $this->db->update('produk', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    public function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('produk');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'failed'), 502);
        }
    }
}
