<?php

class LSoal extends CI_Model
{
    public function getListSoal($kode_topik)
    {
        $this->db->where("kode_topik", $kode_topik);
        $listSoal = $this->db->get("soal")->result_array();
        $ret = array();
        foreach ($listSoal as $el) {

            $this->db->where('id', $el['id']);
            $soal = $this->db->get('soal')->row_array();

            if ($soal['bentuk_soal'] == "drag-and-drop") {
                $this->db->where('id_soal', $el['id']);
                $this->db->where("bentuk", "graf");
                $graf = $this->db->get("soal_graf_text")->result_array();

                $this->db->where('id_soal', $el['id']);
                $this->db->where("bentuk", "node");
                $node = $this->db->get("soal_graf_text")->result_array();

                $this->db->where('id_soal', $el['id']);
                $this->db->where("bentuk", "edge");
                $edge = $this->db->get("soal_graf_text")->result_array();

                $this->db->where("id_soal", $el['id']);
                $this->db->where("id_mhs", $this->session->userdata("id"));
                $cek = $this->db->get("nilai_mhs")->num_rows();

                array_push($ret, array(
                    "id" => $soal['id'],
                    "soal" => $soal['soal'],
                    "bentuk_soal" => $soal['bentuk_soal'],
                    "graf" => $graf,
                    "node" => $node,
                    "edge" => $edge,
                    "tuntas" => $cek > 0 ? true : false,
                ));
            } else if ($soal['bentuk_soal'] == 'pilih-node') {
                $this->db->where('id_soal', $el['id']);
                $node = $this->db->get("node_graf")->result_array();
                $this->db->where('id_soal', $el['id']);
                $this->db->select("id, start_node_id, end_node_id, id_soal, directional, kunci, (SELECT text FROM node_graf WHERE id = start_node_id) as start_text, (SELECT text FROM node_graf WHERE id = end_node_id) as end_text");
                $edge = $this->db->get("edge_graf")->result_array();

                $this->db->where("id_soal", $el['id']);
                $this->db->where("id_mhs", $this->session->userdata("id"));
                $cek = $this->db->get("nilai_mhs")->num_rows();

                array_push($ret, array(
                    "id" => $soal['id'],
                    "soal" => $soal['soal'],
                    "bentuk_soal" => $soal['bentuk_soal'],
                    "node" => $node,
                    "edge" => $edge,
                    "tuntas" => $cek > 0 ? true : false,
                ));
            } else if ($soal['bentuk_soal'] == 'isian-esai') {
                $this->db->where("id_soal", $el['id']);
                $this->db->where("id_mhs", $this->session->userdata("id"));
                $cek = $this->db->get("nilai_mhs")->num_rows();

                array_push($ret, array(
                    "id" => $soal['id'],
                    "soal" => $soal['soal'],
                    "bentuk_soal" => $soal['bentuk_soal'],
                    "tuntas" => $cek > 0 ? true : false,
                ));
            } else {
                $this->db->where('id_soal', $el['id']);
                $node = $this->db->get("node_graf")->result_array();

                $this->db->where("id_soal", $el['id']);
                $this->db->where("id_mhs", $this->session->userdata("id"));
                $cek = $this->db->get("nilai_mhs")->num_rows();

                array_push($ret, array(
                    "id" => $soal['id'],
                    "soal" => $soal['soal'],
                    "bentuk_soal" => $soal['bentuk_soal'],
                    "node" => $node,
                    "tuntas" => $cek > 0 ? true : false,
                ));
            }
        }

        return $ret;
    }

    public function getSoalById($id_soal)
    {
        $ret_array = array();

        $this->db->where('id', $id_soal);
        $soal = $this->db->get('soal')->row_array();

        if ($soal['bentuk_soal'] == "drag-and-drop") {
            $this->db->where('id_soal', $soal['id']);
            $this->db->where("bentuk", "graf");
            $graf = $this->db->get("soal_graf_text")->result_array();

            $this->db->where('id_soal', $soal['id']);
            $this->db->where("bentuk", "node");
            $node = $this->db->get("soal_graf_text")->result_array();

            $this->db->where('id_soal', $soal['id']);
            $this->db->where("bentuk", "edge");
            $edge = $this->db->get("soal_graf_text")->result_array();

            $ret_array = array(
                "id" => $soal['id'],
                "soal" => $soal['soal'],
                "bentuk_soal" => $soal['bentuk_soal'],
                "graf" => $graf,
                "node" => $node,
                "edge" => $edge,
            );
        } else if ($soal['bentuk_soal'] == "pilih-node") {
            $this->db->where("id_soal", $id_soal);
            $node = $this->db->get("node_graf")->result_array();
            $this->db->where("id_soal", $id_soal);
            $this->db->select("id, start_node_id, end_node_id, id_soal, directional, kunci, (SELECT text FROM node_graf WHERE id = start_node_id) as start_text, (SELECT text FROM node_graf WHERE id = end_node_id) as end_text");
            $edge = $this->db->get("edge_graf")->result_array();
            $ret_array = array(
                "id" => $soal['id'],
                "soal" => $soal['soal'],
                "bentuk_soal" => $soal['bentuk_soal'],
                "node" => $node,
                "edge" => $edge
            );
            
        } else {
            $this->db->where('id_soal', $id_soal);
            $node = $this->db->get("node_graf")->result_array();
            $ret_array = array(
                "id" => $soal['id'],
                "soal" => $soal['soal'],
                "bentuk_soal" => $soal['bentuk_soal'],
                "node" => $node
            );
        }

        return $ret_array;
    }

    public function saveJawabanSiswa($data, $bentukSoal)
    {
        if ($bentukSoal == "membuat-graf") {
            $this->db->insert_batch("jawaban_edge_graf", $data);
        }
    }

    public function saveJawabanEsai($data)
    {
        $this->db->where("id_soal", $data['id_soal']);
        $cek = $this->db->get("jawaban_esai");
        if ($cek->num_rows() > 0) {
            $this->db->where("id_soal", $data['id_soal']);
            $this->db->update("jawaban_esai", $data);
            return true;
        }
        $this->db->insert("jawaban_esai", $data);
        return true;
    }

    public function createSoal($kode_topik, $deskripsi, $data, $bentukSoal)
    {
        // begin transaction
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        $this->db->insert("soal", ["soal" => $deskripsi, "kode_topik" => $kode_topik, "bentuk_soal" => $bentukSoal]);
        $id_soal = $this->db->insert_id();

        switch ($bentukSoal) {
            case "membuat-graf":
                $this->_insertNode($data['node'], $id_soal);
                // $this->_insertEdge($data['edge'], $data['directional'], $id_soal);
                break;
            case "membuat-graf-euler":
                $this->_insertNode($data['node'], $id_soal);
                break;
            case "drag-and-drop":
                $this->_insertDragAndDrop($data, $id_soal);
                break;
            case "membuat-matriks":
                $this->_insertNode($data['node'], $id_soal);
                // $this->_insertEdge($data['edge'], $data['directional'], $id_soal);
                break;
            case "pilih-node":
                $this->_insertNode($data['node'], $id_soal);
                $this->_insertEdge($data['edge'], false, $id_soal);
                break;
            case "isian-esai":
                $this->db->insert("kunci_jawaban_esai", ["id_soal" => $id_soal, "jawaban_node" => trim($data['node']), "jawaban_edge" => trim($data['edge'])]);
                break;
            default:
                return false;
                break;
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return "success";
        }
    }

    public function saveKunciJawaban($data)
    {
        $this->db->insert("kunci_jawaban_edge_graf", $data);
    }

    public function saveJawabanPilih($data)
    {
        $this->db->insert("jawaban_pilih", $data);
    }

    public function saveKunciJawabanPilihNode($data)
    {
        $this->db->where("id", $data['id']);
        $this->db->where("id_soal", $data['id_soal']);
        $this->db->set("kunci", true);
        if ($data['bentuk'] == "node") {
            $this->db->update("node_graf");
        } else {
            $this->db->update("edge_graf");
        }
    }

    public function delKunciJawaban($data)
    {
        $this->db->where("id_soal", $data['id_soal']);
        $this->db->where("start_node_id", $data['start_node_id']);
        $this->db->where("end_node_id", $data['end_node_id']);
        $this->db->delete("kunci_jawaban_edge_graf");
    }

    public function delSoal($id_soal)
    {
        $this->db->where("id", $id_soal);
        $this->db->delete("soal");
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }


    public function getGrafTextById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get("soal_graf_text")->row_array();
    }

    public function getJawabanGraf($id_soal, $id_mhs)
    {
        $this->db->where("id_soal", $id_soal);
        $this->db->where("id_mhs", $id_mhs);
        $this->db->order_by("id_soal");
        return $this->db->get("jawaban_edge_graf")->result_array();
    }

    public function getJawabanDrag($id_soal, $id_mhs)
    {
        $this->db->where("id_soal", $id_soal);
        $this->db->where("id_mhs", $id_mhs);
        $this->db->order_by("id_text_graf");
        return $this->db->get("jawaban_graf_text")->result_array();
    }

    public function saveJawabanGrafText($data)
    {
        $this->db->where("id_soal", $data['id_soal']);
        $this->db->where("id_mhs", $data['id_mhs']);
        $this->db->where("id_text_graf", $data['id_text_graf']);
        $getData = $this->db->get("jawaban_graf_text");
        if ($getData->num_rows() > 0) {
            $this->db->where("id", $getData->row_array()["id"]);
            $this->db->update("jawaban_graf_text", $data);
        } else {
            $this->db->insert("jawaban_graf_text", $data);
        }
    }

    public function saveJawabanGraf($data, $bentukSoal)
    {
        $this->db->insert_batch("jawaban_edge_graf", $data);
    }

    public function saveJawabanMatriks($data)
    {
        $this->db->insert("jawaban_edge_graf", $data);
    }

    public function saveNilaiMhs($data)
    {
        $this->db->where("id_mhs", $data['id_mhs']);
        $this->db->where("id_soal", $data['id_soal']);
        if ($this->db->get("nilai_mhs")->num_rows() > 0) {
            return true;
        }
        $this->db->insert("nilai_mhs", $data);
        return true;
    }

    public function saveKunciJawabanDrag($data)
    {
        $this->db->insert_batch("kunci_jawaban_graf_text", $data);
    }

    public function getKunciJawaban($id_soal)
    {
        $this->db->where("id_soal", $id_soal);
        $this->db->order_by("id_soal");
        return $this->db->get("kunci_jawaban_edge_graf")->result_array();
    }

    public function getKunciJawabanDrag($id_soal)
    {
        $this->db->where("id_soal", $id_soal);
        $this->db->order_by("id_text_graf");
        return $this->db->get("kunci_jawaban_graf_text")->result_array();
    }

    public function getKunciJawabanPilih($id_soal)
    {
        $this->db->where("id_soal", $id_soal);
        $this->db->where("kunci", 1);
        $node = $this->db->get("node_graf");
        if ($node->num_rows() > 0) {
            return array(
                "bentuk" => "node",
                "id_kunci" => $node->row_array()['id']
            );
        }

        $this->db->where("id_soal", $id_soal);
        $this->db->where("kunci", 1);
        $edge = $this->db->get("edge_graf");
        if ($edge->num_rows() > 0) {
            return array(
                "bentuk" => "node",
                "id_kunci" => $edge->row_array()['id']
            );
        }

        return false;
    }

    public function getKunciJawabanEsai($id_soal)
    {
        $this->db->where("id_soal", $id_soal);
        return $this->db->get("kunci_jawaban_esai")->row_array();
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
        $ret = $this->db->get('node_graf')->row_array();
        if ($ret != null) {
            return $ret['id'];
        }
        return false;
    }

    private function _insertNode($node, $id_soal)
    {
        $node_insert = array();
        foreach ($node as $el) {
            array_push($node_insert, array(
                "id_soal" => $id_soal,
                "posx" => $el['posx'],
                "posy" => $el['posy'],
                "text" => $el['text']
            ));
        }
        $this->db->insert_batch("node_graf", $node_insert);
    }

    private function _insertEdge($edge, $directional, $id_soal)
    {
        $ret = array();
        $edge_insert = array();
        foreach ($edge as $ell) {
            $edgee = array();
            foreach ($ell as $el) {
                if (!$id_node = $this->getNodeGrafByIdSoalAndText($id_soal, trim($el))) {
                    // if there is edge with node not exist, can happen when there is typo
                    $this->db->trans_rollback();
                    return false;
                }
                array_push($edgee, $id_node);
            }

            array_push($edge_insert, array(
                "id_soal" => $id_soal,
                "start_node_id" => $edgee[0],
                "end_node_id" => $edgee[1],
                "directional" => $directional ? true : false,
                "kunci" => null
            ));
        }

        $this->db->insert_batch("edge_graf", $edge_insert);

        return $ret;
    }

    private function _insertDragAndDrop($data, $id_soal)
    {
        $data_insert = array();
        foreach ($data as $el) {
            array_push($data_insert, array(
                "id_soal" => $id_soal,
                "text" => $el['text'],
                "bentuk" => $el['bentuk']
            ));
        }
        $this->db->insert_batch("soal_graf_text", $data_insert);
    }
}
