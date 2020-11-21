<?php

class LSoal extends CI_Model
{
    public function createSoal($data)
    {
        if (!$this->db->insert("soal", $data)) {
            return false;
        }
        return $this->db->insert_id();
    }

    public function getNodeGraf()
    {
        return $this->db->get("node_graf")->result_array();
    }

    public function getNodeGrafByIdSoal($id_soal)
    {
        $this->db->where("id_soal", $id_soal);
        return $this->db->get("node_graf")->result_array();
    }

    public function getNodeGrafByIdSoalAndText($id_soal, $text)
    {
        $this->db->where("id_soal", $id_soal);
        $this->db->where("text", $text);
        return $this->db->get('node_graf')->row_array();
    }

    public function createNodeGraf($data)
    {
        $this->db->insert_batch("node_graf", $data);
        return true;
    }

    public function createEdgeGraf($data)
    {
        $this->db->insert("edge_graf", $data);
    }
}
