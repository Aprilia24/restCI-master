<?php

require APPPATH . 'libraries/REST_Controller.php';

class Film extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('FilmM');
  }

  // method index untuk menampilkan semua data person menggunakan method get
  public function index_get(){
    $response = $this->FilmM->all_film();
    $this->response($response);
  }

  // untuk menambah person menaggunakan method post
  public function add_post(){
    $response = $this->FilmM->add_film(
        $this->post('judul'),
        $this->post('tgl'),
        $this->post('ket')
      );
    $this->response($response);
  }

  // update data person menggunakan method put
  public function update_put(){
    $response = $this->PersonM->update_film(
        $this->put('id_film'),
        $this->put('judul'),
        $this->put('tgl'),
        $this->put('ket')
      );
    $this->response($response);
  }

  // hapus data person menggunakan method delete
  public function delete_delete(){
    $response = $this->FilmM->delete_film(
        $this->delete('id_film')
      );
    $this->response($response);
  }

}

?>
