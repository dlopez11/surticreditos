<?php

class PaymentController extends ControllerBase
{
    public function indexAction($id)
    {   
        $query = $this->modelsManager->createQuery("SELECT Buy.*, Article.* FROM Buy JOIN Article WHERE Buy.idBuy = {$id}");
        $buys = $query->execute();
        
        if (count($buys) <= 0) {
            $this->flashSession->error("No existe la cuenta de crédito");
            return $this->response->redirect("index");
        }
        
        $payment = Payment::find(array(
            'conditions' => 'idBuy = ?1',
            'bind' => array(1 => $id)
        ));
        
        $this->view->setVar("payments", $payment);
        $this->view->setVar("buys", $buys);
        $this->view->setVar("idBuy", $id);
    }
    
    public function downloadpdfAction($id)
    {
        $d = $this->getData($id);
        
        $idBuy = $d->data[0]['code'];
        $valort = $d->data[0]['value'];
        $valorc = $d->data[0]['dif'];
        $saldo = $d->data[0]['debt'];
        
        require_once "{$this->path->path}app/library/pdf/dompdf_config.inc.php";
        
        $table = "<table style='width:100%'>
                    <thead>
                        <tr>
                            <th>No. de recibo:</th>
                            <th>Valor:</th>		
                            <th>Fecha de pago:</th>
                        </tr>
                    </thead>                        
                    <tbody>";
        
        foreach ($d->data[1] as $data) {
            $tr = "<tr><td>{$data['id']}</td><td>{$data['value']}</td><td>{$data['date']}</td></tr>";
            $table .= $tr;
        }                
        
        $table .= "</tbody></table>";
        
        $content = '
            <html>
                <head>
                    <meta http-equiv="Content-Type" charset="UTF-8" />
                    <title>Ejemplo de Documento en PDF.</title>
                    <style>
                        table, th, td {
                            border: 1px solid black;
                            border-collapse: collapse;
                            font-family: Arial, Helvetica, sans-serif;
                        }
                        th, td {
                            padding: 5px;
                            font-family: Arial, Helvetica, sans-serif;
                        }
                        h2 {
                            text-align: center;
                            font-family: Arial, Helvetica, sans-serif;
                            color: Black;                            
                        }
                    </style>
                </head>
                <body>
                    <div style="text-align:center;">
                        <a href="http://surticreditos.com/" target="_blank">
                            <img src="../public/img/Surticreditos-01.png" height="90"/>
                        </a>
                    </div>
                    <div>
                        <h2>Historial de pagos</h2>
                    </div>
                    <table style="width:100%">
                        <tr>
                            <td><strong>No. de factura:</strong></td>
                            <td>'. $idBuy .'</td>
                        </tr>
                        <tr>
                            <td><strong>Valor total:</strong></td>
                            <td>'. $valort .'</td>
                        </tr>
                        <tr>
                            <td><strong>Valor cancelado:</strong></td>
                            <td>'. $valorc .'</td>
                        </tr>
                        <tr>
                            <td><strong>Saldo:</td>
                            <td>'. $saldo .'</td>
                        </tr>
                    </table><br>
                    ' . $table . '
                </body>
            </html>';
        
        $pdf = new DOMPDF();
        $pdf->set_paper("A4", "portrait");
        $pdf->load_html(utf8_decode($content));
        $pdf ->render();
        $pdf ->stream('Ejemplo.pdf');
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