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
        switch ($bentukSoal) {
            case "membuat-graf":
                $deskripsiSoal = $this->input->post("deskripsiSoal");
                $listNode = $this->input->post("listNode");
                $listEdge = $this->input->post('listEdge');
                $directional = $this->input->post('directional');

                $listNode = $this->getNode($listNode);
                $listEdge = $this->getEdge($listEdge);

                $listConnect = array();
                foreach ($listEdge as $el) {
                    array_push($listConnect, $this->connectEdge($el));
                }
                $message = $this->LSoal->createSoal($kode_topik, $deskripsiSoal, ['node' => $listNode, 'edge' => $listConnect, 'directional' => $directional], $bentukSoal);

                $response = array(
                    "deskripsi" => $deskripsiSoal,
                    "node" => $listNode,
                    "edge" => $listEdge,
                    "connect" => $listConnect,
                    "directional" => $directional,
                    "message" => $message
                );
                break;
            case "membuat-graf-euler":
                $deskripsiSoal = $this->input->post("deskripsiSoal");
                $listNode = $this->input->post("listNode");

                $listNode = $this->getNode($listNode);
                $message = $this->LSoal->createSoal($kode_topik, $deskripsiSoal, ['node' => $listNode, 'edge' => $listConnect], $bentukSoal);

                $response = array(
                    "deskripsi" => $deskripsiSoal,
                    "node" => $listNode,
                    "message" => $message
                );
                break;
            case "drag-and-drop":
                $deskripsiSoal = $this->input->post("deskripsiSoal");
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
                break;
            case "membuat-matriks":
                $deskripsiSoal = $this->input->post("deskripsiSoal");
                $listNode = $this->input->post("listNode");
                $listEdge = $this->input->post('listEdge');
                $directional = $this->input->post('directional');

                $listNode = $this->getNode($listNode);
                $listEdge = $this->getEdge($listEdge);

                $listConnect = array();
                foreach ($listEdge as $el) {
                    array_push($listConnect, $this->connectEdge($el));
                }
                $message = $this->LSoal->createSoal($kode_topik, $deskripsiSoal, ['node' => $listNode, 'edge' => $listConnect, 'directional' => $directional], $bentukSoal);

                $response = array(
                    "deskripsi" => $deskripsiSoal,
                    "node" => $listNode,
                    "edge" => $listEdge,
                    "connect" => $listConnect,
                    "directional" => $directional,
                    "message" => $message
                );
                break;
            case "pilih-node":
                $deskripsiSoal = $this->input->post("deskripsiSoal");
                $listNode = $this->input->post("listNode");
                $listEdge = $this->input->post('listEdge');
                $directional = $this->input->post('directional');

                $listNode = $this->getNode($listNode);
                $listEdge = $this->getEdge($listEdge);

                $listConnect = array();
                foreach ($listEdge as $el) {
                    array_push($listConnect, $this->connectEdge($el));
                }
                $message = $this->LSoal->createSoal($kode_topik, $deskripsiSoal, ['node' => $listNode, 'edge' => $listConnect, 'directional' => $directional], $bentukSoal);

                $response = array(
                    "deskripsi" => $deskripsiSoal,
                    "node" => $listNode,
                    "edge" => $listEdge,
                    "connect" => $listConnect,
                    "directional" => $directional,
                    "message" => $message
                );
                break;
            case "isian-array":
                $deskripsiSoal = $this->input->post("deskripsiSoal");
                $listNode = $this->input->post("listNode");
                $listEdge = $this->input->post('listEdge');
                $directional = $this->input->post('directional');

                $listNode = $this->getNode($listNode);
                $listEdge = $this->getEdge($listEdge);

                $listConnect = array();
                foreach ($listEdge as $el) {
                    array_push($listConnect, $this->connectEdge($el));
                }
                $message = $this->LSoal->createSoal($kode_topik, $deskripsiSoal, ['node' => $listNode, 'edge' => $listConnect, 'directional' => $directional], $bentukSoal);

                $response = array(
                    "deskripsi" => $deskripsiSoal,
                    "node" => $listNode,
                    "edge" => $listEdge,
                    "connect" => $listConnect,
                    "directional" => $directional,
                    "message" => $message
                );
                break;
        }

        echo json_encode($response);
        return true;
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
