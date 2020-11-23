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

            if ($soal['bentuk_soal'] != "drag-and-drop") {
                $this->db->where('id_soal', $el['id']);
                $node = $this->db->get("node_graf")->result_array();
                array_push($ret, array(
                    "id" => $soal['id'],
                    "soal" => $soal['soal'],
                    "bentuk_soal" => $soal['bentuk_soal'],
                    "node" => $node
                ));
            } else {
                $this->db->where('id_soal', $el['id']);
                $this->db->where("bentuk", "graf");
                $graf = $this->db->get("soal_graf_text")->result_array();

                $this->db->where('id_soal', $el['id']);
                $this->db->where("bentuk", "node");
                $node = $this->db->get("soal_graf_text")->result_array();

                $this->db->where('id_soal', $el['id']);
                $this->db->where("bentuk", "edge");
                $edge = $this->db->get("soal_graf_text")->result_array();

                array_push($ret, array(
                    "id" => $soal['id'],
                    "soal" => $soal['soal'],
                    "bentuk_soal" => $soal['bentuk_soal'],
                    "graf" => $graf,
                    "node" => $node,
                    "edge" => $edge,
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

        if ($soal['bentuk_soal'] != "drag-and-drop") {
            $this->db->where('id_soal', $id_soal);
            $node = $this->db->get("node_graf")->result_array();
            $ret_array = array(
                "id" => $soal['id'],
                "soal" => $soal['soal'],
                "bentuk_soal" => $soal['bentuk_soal'],
                "node" => $node
            );
        } else {
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
        }

        return $ret_array;
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
                $this->_insertEdge($data['edge'], $data['directional'], $id_soal);
                break;
            case "membuat-graf-euler":
                $this->_insertNode($data['node'], $id_soal);
                break;
            case "drag-and-drop":
                $this->_insertDragAndDrop($data, $id_soal);
                break;
            case "membuat-matriks":
                $this->_insertNode($data['node'], $id_soal);
                $this->_insertEdge($data['edge'], $data['directional'], $id_soal);
                break;
            case "pilih-node":
                $this->_insertNode($data['node'], $id_soal);
                $this->_insertEdge($data['edge'], $data['directional'], $id_soal);
                break;
            case "isian-array":
                $this->_insertNode($data['node'], $id_soal);
                $this->_insertEdge($data['edge'], $data['directional'], $id_soal);
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
