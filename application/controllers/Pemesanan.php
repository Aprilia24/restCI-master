<?php

require APPPATH . 'libraries/REST_Controller.php';

class Pemesanan extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('PemesananM');
  }

  // method index untuk menampilkan semua data person menggunakan method get
  public function index_get(){
    $response = $this->PemesananM->all_pemesan();
    $this->response($response);
  }

  // untuk menambah person menaggunakan method post
  public function add_post(){
    $response = $this->PemesananM->add_pemesan(
        $this->post('nm_pemesan'),
        $this->post('jk'),
        $this->post('no_hp'),
        $this->post('alamat')
      );
    $this->response($response);
  }

  // update data person menggunakan method put
  public function update_put(){
    $response = $this->PemesananM->update_pemesan(
        $this->put('id_pemesan'),
        $this->put('nm_pemesan'),
        $this->put('jk'),
        $this->put('no_hp'),
        $this->put('alamat')
      );
    $this->response($response);
  }

  // hapus data person menggunakan method delete
  public function delete_delete(){
    $response = $this->PemesananM->delete_pemesan(
        $this->delete('id_pemesan')
      );
    $this->response($response);
  }

}

?>
