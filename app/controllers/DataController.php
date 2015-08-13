<?php

class DataController extends ControllerBase
{  
    public function getAction($id)
    {
        $data = $this->getData($id);
        return $this->set_json_response($data->data, $data->code);
    }
    
    public function createAction()
    {                
        try{
            $PHPExcel = new \Surticreditos\Misc\PHPExcel();
            $PHPExcel->setLogoDir("{$this->path->path}public/img/excel/surticreditos.png");
            $PHPExcel->setUser($this->user);
            $PHPExcel->setData($this->getData($id));
            $PHPExcel->create();
            $this->report = $PHPExcel->getReportData(); 
        }
        catch (Exception $ex){
            $this->logger->log($ex->getMessage());
            return $this->set_json_response('ha ocurrido un error, por favor contacte al administrador', 500); 
        }
    }
    
    public function downloadAction($idReport)
    {
        $tmpreport = Tmpreport::findFirst(array(
            'conditions' => 'idTmpreport = ?1 AND idUser = ?2',
            'bind' => array(1 => $idReport,
                2 => $this->user->idUser)
        ));

        if (!$tmpreport) {
            return $this->response->redirect('error');
        }

        $this->view->disable();

        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename={$tmpreport->name}");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Pragma: no-cache');

        $folder = "{$this->path->path}{$this->path->tmpfolder}{$this->user->idUser}/{$tmpreport->name}";
        readfile($folder);
    }
    
    private function getData($id)
    {
        $std = new stdClass();
        
        $user = $this->user->idUser;
        
        $buy = Buy::findFirst(array(
            'conditions' => 'idBuy = ?1 AND idUser = ?2',
            'bind' => array(1 => $id,
                            2 => $user)
        ));
        
        if(!$buy){
            $std->data = array('No se han encontrado datos, por favor valide la información');
            $std->code = 404;
            return $std;
        }
        else{
            $rec = array();
            
            $payment = Payment::find(array(
                'conditions' => 'idBuy = ?1 ORDER BY date DESC',
                'bind' => array(1 => $id)
            ));
            
            if (count($payment) > 0) {
                foreach ($payment as $p) {
                    $array = array();
                    $array['id'] = $p->idPayment;
                    $array['value'] = '$' . number_format($p->receiptValue);
                    $array['date'] = $p->date;
                    
                    $rec[] = $array;
                }
            }
            
            $datos = array(
                'code' => $buy->idBuy,
                'value' => '$' . number_format($buy->value),
                'dif' => '$' . number_format($buy->value - $buy->debt),
                'debt' => '$' . number_format($buy->debt)
            );
            
            
            $data = array($datos, $rec);
            
            $std->data = $data;
            $std->code = 200;
            return $std;
        }
    }        
}