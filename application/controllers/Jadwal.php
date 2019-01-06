<?php

require APPPATH . 'libraries/REST_Controller.php';

class Jadwal extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('JadwalM');
  }

  // method index untuk menampilkan semua data person menggunakan method get
  public function index_get(){
    $response = $this->JadwalM->all_jadwal();
    $this->response($response);
  }

  // untuk menambah person menaggunakan method post
  public function add_post(){
    $response = $this->JadwalM->add_jadwal(
        $this->post('id_film'),
        $this->post('tanggal'),
        $this->post('jam_berakhir'),
        $this->post('jam_mulai')
      );
    $this->response($response);
  }

  // update data person menggunakan method put
  public function update_put(){
    $response = $this->JadwalM->update_jadwal(
        $this->put('id_film'),
        $this->put('tanggal'),
        $this->put('jam_berakhir'),
        $this->put('jam_mulai')
      );
    $this->response($response);
  }

  // hapus data person menggunakan method delete
  public function delete_delete(){
    $response = $this->JadwalM->delete_jadwal(
        $this->delete('id_jadwal')
      );
    $this->response($response);
  }

}

?>
