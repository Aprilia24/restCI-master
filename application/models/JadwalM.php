<?php

// extends class Model
class JadwalM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tb_person
  public function add_jadwal($id_film,$tanggal,$jam_berakhir,$jam_mulai){

    if(empty($id_film) || empty($tanggal) || empty($jam_berakhir) || empty($jam_mulai)){
      return $this->empty_response();
    }else{
      $data = array(
        "id_film"=>$id_film,
        "tanggal"=>$tanggal,
        "jam_berakhir"=>$jam_berakhir,
        "jam_mulai"=>$jam_mulai
      );

      $insert = $this->db->insert("jadwal", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data jadwal ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data jadwal gagal ditambahkan.';
        return $response;
      }
    }

  }

  // mengambil semua data person
  public function all_jadwal(){

    $all = $this->db->get("jadwal")->result();
    $response['status']=200;
    $response['error']=false;
    $response['person']=$all;
    return $response;

  }

  // hapus data person
  public function delete_jadwal($id_jadwal){

    if($id_jadwal == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id_jadwal"=>$id_jadwal
      );

      $this->db->where($where);
      $delete = $this->db->delete("jadwal");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data jadwal dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data jadwal gagal dihapus.';
        return $response;
      }
    }

  }

  // update person
  public function update_jadwal($id_jadwal,$id_film,$tanggal,$jam_berakhir,$jam_mulai){

    if($id_jadwal == '' || empty($id_film) || empty($tanggal) || empty($jam_berakhir) || empty($jam_mulai)){
      return $this->empty_response();
    }else{
      $where = array(
        "id_jadwal"=>$id_jadwal
      );

      $set = array(
        "id_film"=>$id_film,
        "tanggal"=>$tanggal,
        "jam_berakhir"=>$jam_berakhir,
        "jam_mulai"=>$jam_mulai
      );

      $this->db->where($where);
      $update = $this->db->update("jadwal",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data jadwal diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data jadwal gagal diubah.';
        return $response;
      }
    }

  }

}

?>
