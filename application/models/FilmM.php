<?php

// extends class Model
class FilmM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tb_person
  public function add_film($judul,$tgl,$ket){
    $data = array(
      "judul"=>$judul,
      "tgl"=>$tgl,
      "ket"=>$ket
    );

    $insert = $this->db->insert("film", $data);

    if($insert){
      $response['status']=200;
      $response['error']=false;
      $response['message']='Data film ditambahkan.';
      return $response;
    }else{
      $response['status']=502;
      $response['error']=true;
      $response['message']='Data film gagal ditambahkan.';
      return $response;
    }
  }

  public function find_by_id($id_film)
  {
    $film = $this->db->from('film')->where('id_film', $id_film)->get()->row_array();
    $response = [
      'error' => false,
      'status' => 200,
      'film' => $film,
    ];
    return $response;
  }

  // mengambil semua data person
  public function all_film(){

    $all = $this->db->get("film")->result();
    $response['status']=200;
    $response['error']=false;
    $response['person']=$all;
    return $response;

  }

  // hapus data person
  public function delete_film($id_film)
  {
      $this->db->where('id_film', $id_film)->delete('film');
      $rows = $this->db->affected_rows();
      
      if ($rows > 0)
      {
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data film dihapus.';
        return $response;
      }
      else
      {
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data film gagal dihapus.';
        return $response;
      }
  }

  // update person
  public function update_film($id_film, $judul, $tgl, $ket){
      $set = array(
        "judul"=>$judul,
        "tgl"=>$tgl,
        "ket"=>$ket
      );

      $update = $this->db->where('id_film', $id_film)->update("film", $set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data film diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data film gagal diubah.';
        return $response;
      }
  }

}
