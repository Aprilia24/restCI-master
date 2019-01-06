<?php

class FilmM extends CI_Model
{
  public function create($judul, $tgl, $ket)
  {
    $data = array(
      "judul" => $judul,
      "tgl" => $tgl,
      "ket" => $ket
    );

    $this->db->insert("film", $data);
    $id_film = $this->db->insert_id();
    $film = $this->db->from('film')->where('id_film', $id_film)->get()->row_array();
    return $film;
  }

  public function find_by_id($id_film)
  {
    $film = $this->db->from('film')->where('id_film', $id_film)->get()->row_array();
    return $film;
  }

  // mengambil semua data person
  public function all()
  {
    $films = $this->db->get('film')->result_array();
    return $films;
  }

  public function delete($id_film)
  {
      $this->db->where('id_film', $id_film)->delete('film');
      $rows = $this->db->affected_rows();
      return $rows;
  }

  // update person
  public function update($id_film, $judul, $tgl, $ket)
  {
    $set = array(
      "judul"=>$judul,
      "tgl"=>$tgl,
      "ket"=>$ket
    );

    $this->db->where('id_film', $id_film)->update("film", $set);
    $film = $this->db->from('film')->where('id_film', $id_film)->get()->row_array();
    return $film;
  }
}
