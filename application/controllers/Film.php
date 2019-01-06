<?php

require APPPATH . 'libraries/REST_Controller.php';

class Film extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('FilmM');
  }

  // method index untuk menampilkan semua data person menggunakan method get
  public function index_get($id = 0)
  {
    if ($id > 0)
    {
      $response = $this->FilmM->find_by_id($id);
    }
    else
    {
      $response = $this->FilmM->all_film();
    }

    $this->response($response);
  }

  // untuk menambah person menaggunakan method post
  public function index_post(){
    $response = $this->FilmM->add_film(
        $this->post('judul'),
        $this->post('tgl'),
        $this->post('ket')
    );
    $this->response($response);
  }

  // update data person menggunakan method put
  public function index_put($id = 0){
    $response = $this->FilmM->update_film(
      $id,
      $this->put('judul'),
      $this->put('tgl'),
      $this->put('ket')
    );
    $this->response($response);
  }

  // hapus data person menggunakan method delete
  public function index_delete($id = 0)
  {
    $response = $this->FilmM->delete_film($id);
    $this->response($response);
  }
}
