<?php
defined('BASEPATH') or exit('No direct script access allowed');

class API extends CI_Controller
{
    public function getSoal()
    {
    }

    public function saveSoal($bentukSoal)
    {
        header('Content-Type: application/json');
        if ($bentukSoal === "membuat-graf") {
            $deskripsiSoal = $this->input->post("deskripsiSoal");
            $listNode = $this->input->post("listNode");
            $listEdge = $this->input->post('listEdge');

            $listNode = $this->getNode($listNode);
            $listEdge = $this->getEdge($listEdge);

            $id_soal = $this->createSoal($deskripsiSoal);
            $this->saveNodeToDatabase($id_soal, $listNode);
            $listConnect = array();
            foreach ($listEdge as $el) {
                array_push($listConnect, $this->connectEdge($el));
            }

            foreach ($listConnect as $el) {
                $this->saveEdgeToDatabase($id_soal, $el);
            }

            $response = array(
                "deskripsi" => $deskripsiSoal,
                "node" => $listNode,
                "edge" => $listEdge,
                "connect" => $listConnect
            );

            echo json_encode($response);
            return true;
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

        return $arr_ret;
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

    private function createSoal($deskripsi)
    {
        return $this->LSoal->createSoal(["soal" => $deskripsi]);
    }

    private function saveNodeToDatabase($id_soal, $node)
    {
        $arr_insert = array();
        $posx = 25;
        $posy = 100;
        $iterate = 1;
        foreach ($node as $el) {
            $arr = array(
                "id_soal" => $id_soal,
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

        $this->LSoal->createNodeGraf($arr_insert);
    }

    private function saveEdgeToDatabase($id_soal, $edge)
    {
        $id_edge = array();
        foreach ($edge as $el) {
            $id_node = $this->LSoal->getNodeGrafByIdSoalAndText($id_soal, $el);
            if (!$id_node['id']) {
                echo json_encode(["message" => "error, node \"" . $el . "\" tidak ada. Cek kembali list node dan edge"]);
                die();
            }

            array_push($id_edge, $id_node['id']);
        }

        $arr_insert = array(
            "id_soal" => $id_soal,
            "start_node_id" => $id_edge[0],
            "end_node_id" => $id_edge[1],
            "directional" => false,
            "kunci" => null
        );

        $this->LSoal->createEdgeGraf($arr_insert);
    }
}
