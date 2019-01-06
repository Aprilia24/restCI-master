<?php

class TiketM extends CI_Model
{
  public function create($harga, $stok)
  {
    $data = array(
      "harga" => $harga,
      "stok" => $stok,
    );

    $this->db->insert("tiket", $data);
    $id_tiket = $this->db->insert_id();
    $tiket = $this->db->from('tiket')->where('id_tiket', $id_tiket)->get()->row_array();
    return $tiket;
  }

  public function find_by_id($id_tiket)
  {
    $tiket = $this->db->from('tiket')->where('id_tiket', $id_tiket)->get()->row_array();
    return $tiket;
  }

  public function all()
  {
    $tikets = $this->db->get('tiket')->result_array();
    return $tikets;
  }

  public function delete($id_tiket)
  {
      $this->db->where('id_tiket', $id_tiket)->delete('tiket');
      $rows = $this->db->affected_rows();
      return $rows;
  }

  public function update($id_tiket, $harga, $stok)
  {
    $set = array(
      "harga"=>$harga,
      "stok"=>$stok,
    );

    $this->db->where('id_tiket', $id_tiket)->update("tiket", $set);
    $tiket = $this->db->from('tiket')->where('id_tiket', $id_tiket)->get()->row_array();
    return $tiket;
  }
}
