<?php
defined('BASEPATH') or exit('No direct script access allowed');

class API extends CI_Controller
{
    public function getSoal($kode_topik)
    {
        header("Content-Type: application/json");
        echo json_encode($this->LSoal->getListSoal($kode_topik));
    }

    public function getSoalById($id_soal)
    {
        header("Content-Type: application/json");
        echo json_encode($this->LSoal->getSoalById($id_soal));
    }

    public function saveSoal($kode_topik, $bentukSoal)
    {
        header('Content-Type: application/json');
        $response = array();
        $kode_topik = $this->uri->segment(3);

        $deskripsiSoal = $this->input->post("deskripsiSoal");

        if ($bentukSoal != "drag-and-drop") {
            $listNode = $this->getNode($this->input->post("listNode"));
            $message = $this->LSoal->createSoal($kode_topik, $deskripsiSoal, ['node' => $listNode], $bentukSoal);

            $response = array(
                "deskripsi" => $deskripsiSoal,
                "data" => $listNode,
                "message" => $message
            );
        } else {
            $dataSoalGraf = $this->input->post("dataSoalGraf");
            $dataSoalNode = $this->input->post("dataSoalNode");
            $dataSoalEdge = $this->input->post('dataSoalEdge');

            $graf = $this->getDragAndDrop($dataSoalGraf, "graf");
            $node = $this->getDragAndDrop($dataSoalNode, "node");
            $edge = $this->getDragAndDrop($dataSoalEdge, "edge");

            $message = $this->LSoal->createSoal($kode_topik, $deskripsiSoal, array_merge($graf, $node, $edge), $bentukSoal);

            $response = array(
                "deskripsi" => $deskripsiSoal,
                "data" => array_merge($graf, $node, $edge),
                "message" => $message
            );
        }
        // TODO: implement isian esai, OR array
        echo json_encode($response);
        return true;
    }

    public function saveKunciJawaban()
    {
        header("Content-Type: application/json");
        // $response = array();
        $bentukSoal = $this->input->post("bentukSoal");
        $dataKunci = $this->input->post("dataKunci");

        $arrKunci = array();
        $arrDel = array();

        if ($bentukSoal != "drag-and-drop") {
            foreach ($dataKunci as $el) {
                if ($el["checked"] == true) {
                    array_push($arrKunci, array(
                        "id_soal" => $el['id_soal'],
                        "start_node_id" => $el['start_node'],
                        "end_node_id" => $el['end_node'],
                        "directional" => $el['directional']
                    ));
                } else {
                    $this->LSoal->delKunciJawaban(array(
                        "id_soal" => $el['id_soal'],
                        "start_node_id" => $el['start_node'],
                        "end_node_id" => $el['end_node'],
                    ));
                }
            }

            $this->LSoal->saveKunciJawaban($arrKunci);
        } else {
            foreach ($dataKunci as $el) {
                array_push($arrKunci, array(
                    "id_soal" => $el['id_soal'],
                    "id_text_graf" => $el['id_text_graf'],
                    "id_text_node" => $el['id_text_node'],
                    "id_text_edge" => $el['id_text_edge']
                ));
            }

            $this->LSoal->saveKunciJawabanDrag($arrKunci);
        }

        echo json_encode(["message" => "success", "data" => $arrKunci, "del" => $arrDel]);
        return true;
    }

    public function getKunciJawaban($id_soal, $bentukSoal)
    {
        header("Content-Type: application/json");
        $response = "";

        if ($bentukSoal != "drag-and-drop") {
            $response = $this->LSoal->getKunciJawaban($id_soal);
        } else {
            $response = $this->LSoal->getKunciJawabanDrag($id_soal);
        }

        echo json_encode($response);
        return true;
    }

    public function delSoal($id_soal)
    {
        header("Content-Type: application/json");
        $response = $this->LSoal->delSoal($id_soal);

        echo json_encode($response);
        return true;
    }

    public function saveJawabanSiswa($id_soal)
    {
        header("Content-Type: application/json");
        $bentukSoal = $this->input->post("bentukSoal");
        $dataJawaban = $this->input->post("dataJawaban");
        $id_mhs = $this->session->userdata("id");

        $response = "";

        if ($bentukSoal == "drag-and-drop") {
            $response = array(
                "message" => "success",
                "nilai" => 0,
                "data" => $dataJawaban
            );
        } else if ($bentukSoal == "membuat-graf") {
            $response = array(
                "message" => "success",
                "nilai" => 0,
                "data" => $dataJawaban
            );
        }

        echo json_encode($response);
        return true;
    }

    private function checkJawabanGraf($idSoal, $dataJawaban, $idMhs, $bentukSoal)
    {
        $kirim = array();
        foreach ($dataJawaban as $el) {
            array_push($kirim, array(
                "bobot" => $el['bobot'],
                "directional" => $el['directional'],
                "end_node_id" => $el['end_node_id'],
                "start_node_id" => $el['start_node_id'],
                "id_mhs" => $idMhs,
                "id_soal" => $idSoal,
            ));
        }

        $this->LSoal->saveJawabanSiswa($kirim, $bentukSoal);
    }

    private function checkJawabanDrag($idSoal, $dataJawaban, $idMhs)
    {
        $kunciJawaban = $this->LSoal->getKunciJawabanDrag($idSoal);
        $ret_array = array();

        foreach ($dataJawaban as $jawaban) {
            $idxKunci = 0;
            for ($i = 0; $i < sizeof($kunciJawaban); $i++) {
                if ($jawaban['id_text_graf'] == $kunciJawaban[$i]["id_text_graf"]) {
                    $idxKunci = $i;
                    break;
                }
            }

            if ($jawaban['id_jawaban'] == $kunciJawaban[$idxKunci]["id_text_node"]) {
                array_push($ret_array, array(
                    ""
                ));
            }
        }
    }

    private function getNode($node)
    {
        $start = strpos($node, "{");
        $end = strpos($node, "}", $start + 1);
        $len = $end - $start;
        $listnode = substr($node, $start + 1, $len - 1);
        $arrnode = explode(",", $listnode);

        $arr_ret = [];
        foreach ($arrnode as $el) {
            array_push($arr_ret, trim($el));
        }

        $arr_insert = array();
        $posx = 25;
        $posy = 100;
        $iterate = 1;
        foreach ($arr_ret as $el) {
            $arr = array(
                "posx" => $posx,
                "posy" => $iterate % 2 == 0 ? $posy - 20 : $posy,
                "text" => $el
            );
            array_push($arr_insert, $arr);

            if ($posx <= 750) {
                $posx += 50;
            } else {
                $posx = 25;
                $posy += 50;
            }
            $iterate++;
        }

        return $arr_insert;
    }

    private function getEdge($edge)
    {
        $start = strpos($edge, "{");
        $end = strpos($edge, "}", $start + 1);
        $len = $end - $start;
        $listedge = substr($edge, $start + 1, $len - 1);
        $arredge = explode(";", $listedge);

        $arr_ret = [];
        foreach ($arredge as $el) {
            array_push($arr_ret, trim($el));
        }

        return $arr_ret;
    }

    private function connectEdge($edge)
    {
        $start = strpos($edge, "(");
        $end = strpos($edge, ")", $start + 1);
        $len = $end - $start;
        $listedge = substr($edge, $start + 1, $len - 1);
        $arredge = explode(",", $listedge);

        $arr_ret = array();
        $arr_ret['start_node'] = trim($arredge[0]);
        $arr_ret['end_node'] = trim($arredge[1]);

        return $arr_ret;
    }

    private function getDragAndDrop($data, $bentuk)
    {
        $ret_array = array();
        foreach ($this->explodeArray($data) as $el) {
            array_push($ret_array, array(
                "text" => $el,
                "bentuk" => $bentuk
            ));
        }

        return $ret_array;
    }

    private function explodeArray($data)
    {
        $start = strpos($data, "{");
        $end = strpos($data, "}", $start + 1);
        $len = $end - $start;
        $listdata = substr($data, $start + 1, $len - 1);
        $arrdata = explode(",", $listdata);

        $arr_ret = array();
        foreach ($arrdata as $el) {
            array_push($arr_ret, trim($el));
        }

        return $arr_ret;
    }
}
