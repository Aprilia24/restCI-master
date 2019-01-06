<?php

require APPPATH . 'libraries/REST_Controller.php';

class Tiket extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('TiketM');
  }

  public function index_get($id = 0)
  {
    if ($id > 0)
    {
      $tiket = $this->TiketM->find_by_id($id);
      return $this->response(['data' => $tiket]);
    }
    else
    {
      $tikets = $this->TiketM->all();
      return $this->response(['data' => $tikets]);
    }
  }

  public function index_post()
  {
    $this->form_validation->set_rules('harga', 'Harga', ['required', 'numeric']);
    $this->form_validation->set_rules('stok', 'Stok', ['required', 'numeric']);
    
    if ($this->form_validation->run() == FALSE)
    {
      $response = [
        'errors' => $this->form_validation->error_array(),
        'message' => $this->form_validation->error_string(),
      ];
      return $this->response($response, 400);
    }


    $tiket = $this->TiketM->create(
        $this->post('harga'),
        $this->post('stok')
    );
    $response = [
      'data' => $tiket,
      'message' => 'Tiket berhasil ditambahkan',
    ]; 
    return $this->response($response);
  }

  public function index_put($id = 0)
  {
    $this->form_validation->set_data([
      'harga' => $this->put('harga'),
      'stok' => $this->put('stok'),
    ]);
    $this->form_validation->set_data($this->input->post());
    $this->form_validation->set_rules('harga', 'Harga', ['required', 'numeric']);
    $this->form_validation->set_rules('stok', 'Stok', ['required', 'numeric']);

    if ($this->form_validation->run() === FALSE)
    {
      $response = [
        'errors' => $this->form_validation->error_array(),
        'message' => $this->form_validation->error_string(),
      ];
      return $this->response($response, 400);
    }


    $tiket = $this->TiketM->update(
      $id,
      $this->put('harga'),
      $this->put('stok')
    );
    $response = [
      'data' => $tiket,
      'message' => 'Tiket berhasil diubah',
    ];
    return $this->response($response);
  }

  public function index_delete($id = 0)
  {
    $rows = $this->TiketM->delete($id);
    
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
