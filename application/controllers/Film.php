<?php

require APPPATH . 'libraries/REST_Controller.php';

class Film extends REST_Controller
{
  // construct
  public function __construct()
  {
    parent::__construct();
    $this->load->model('FilmM');
  }

  // method index untuk menampilkan semua data person menggunakan method get
  public function index_get($id = 0)
  {
    if ($id > 0)
    {
      $film = $this->FilmM->find_by_id($id);
      return $this->response(['data' => $film]);
    }
    else
    {
      $films = $this->FilmM->all();
      return $this->response(['data' => $films]);
    }
  }

  // untuk menambah person menaggunakan method post
  public function index_post()
  {
    $this->form_validation->set_rules('judul', 'Judul', ['required']);
    $this->form_validation->set_rules('tgl', 'Tanggal', ['required']);
    $this->form_validation->set_rules('ket', 'Keterangan', ['required']);

    if ($this->form_validation->run() == FALSE)
    {
      $response = [
        'errors' => $this->form_validation->error_array(),
        'message' => $this->form_validation->error_string(),
      ];
      return $this->response($response, 400);
    }


    $film = $this->FilmM->create(
        $this->post('judul'),
        $this->post('tgl'),
        $this->post('ket')
    );
    $response = [
      'data' => $film,
      'message' => 'Film berhasil ditambahkan',
    ]; 
    return $this->response($response);
  }

  // update data person menggunakan method put
  public function index_put($id = 0)
  {
    $this->form_validation->set_data([
      'judul' => $this->put('judul'),
      'tgl' => $this->put('tgl'),
      'ket' => $this->put('ket'),  
    ]);
    $this->form_validation->set_data($this->input->post());
    $this->form_validation->set_rules('judul', 'Judul', ['required']);
    $this->form_validation->set_rules('tgl', 'Tanggal', ['required']);
    $this->form_validation->set_rules('ket', 'Keterangan', ['required']);

    if ($this->form_validation->run() === FALSE)
    {
      $response = [
        'errors' => $this->form_validation->error_array(),
        'message' => $this->form_validation->error_string(),
      ];
      return $this->response($response, 400);
    }


    $film = $this->FilmM->update(
      $id,
      $this->put('judul'),
      $this->put('tgl'),
      $this->put('ket')
    );
    $response = [
      'data' => $film,
      'message' => 'Film berhasil diubah',
    ];
    return $this->response($response);
  }

  // hapus data person menggunakan method delete
  public function index_delete($id = 0)
  {
    $rows = $this->FilmM->delete($id);
    
    if ($rows > 0)
    {
      $response['message'] = 'Data berhasil dihapus ('.$rows.')';
      return $this->response($response);
    }
    else
    {
      $response['message'] = 'Data tidak ditemukan / tidak berhasil dihapus';
      return $this->response($response, 400);
    }
  }
}
