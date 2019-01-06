<?php

// extends class Model
class PemesananM extends CI_Model{

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tb_person
  public function add_pemesan($nm_pemesan,$jk,$no_hp,$alamat){

    if(empty($nm_pemesan) || empty($jk) || empty($no_hp) || empty($alamat)){
      return $this->empty_response();
    }else{
      $data = array(
        "nm_pemesan"=>$nm_pemesan,
        "jk"=>$jk,
        "no_hp"=>$no_hp,
        "alamat"=>$alamat
      );

      $insert = $this->db->insert("pemesan", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data pemesan ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data pemesan gagal ditambahkan.';
        return $response;
      }
    }

  }

  // mengambil semua data person
  public function all_pemesan(){

    $all = $this->db->get("pemesan")->result();
    $response['status']=200;
    $response['error']=false;
    $response['person']=$all;
    return $response;

  }

  // hapus data person
  public function delete_pemesan($id_pemesan){

    if($id_pemesan == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id_pemesan"=>$id_pemesan
      );

      $this->db->where($where);
      $delete = $this->db->delete("pemesan");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data pemesan dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data pemesan gagal dihapus.';
        return $response;
      }
    }

  }

  // update person
  public function update_pemesan($id_pemesan,$nm_pemesan,$jk,$no_hp,$alamat){

    if($id_pemesan == '' || empty($nm_pemesan) || empty($jk) || empty($no_hp) || empty($alamat)){
      return $this->empty_response();
    }else{
      $where = array(
        "id_pemesan"=>$id_pemesan
      );

      $set = array(
        "nm_pemesan"=>$nm_pemesan,
        "jk"=>$jk,
        "no_hp"=>$no_hp,
        "alamat"=>$alamat
      );

      $this->db->where($where);
      $update = $this->db->update("pemesan",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data pemesan diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data pemesan gagal diubah.';
        return $response;
      }
    }

  }

}

?>
