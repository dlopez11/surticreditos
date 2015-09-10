<?php

class PaymentController extends ControllerBase
{
    public function indexAction($id)
    {               
        $payment = Payment::find(array(
            'conditions' => 'idBuy = ?1',
            'bind' => array(1 => $id)
        ));
        
        $query = $this->modelsManager->createQuery("SELECT Buy.*, Article.* FROM Buy JOIN Article WHERE Buy.idBuy = {$id}");
        $buys = $query->execute();
        
        $this->view->setVar("payments", $payment);
        $this->view->setVar("buys", $buys);
    }
    
    public function downloadpdfAction()
    {
        $path = \Phalcon\DI\FactoryDefault::getDefault()->get('path');
        require_once "{$path->path}app/library/pdf/dompdf_config.inc.php";
        
        $content = '
            <html>
                <head>
                    <meta http-equiv="Content-Type" charset="UTF-8" />
                    <title>Ejemplo de Documento en PDF.</title>
                </head>
                <body>
                    <a href="http://surticreditos.com/" target="_blank">
                        <img src="../public/img/Surticreditos-01.png" height="70" align="center" />
                    </a>
                    <br />
                    <br />
                    <table class="table table-bordered">
                        <tr>
                            <td>Numero de factura:</td>
                            <td>85236</td>
                        </tr>
                        <tr>
                            <td>Valor total:</td>
                            <td>$500.000</td>
                        </tr>
                        <tr>
                            <td>Valor cancelado:</td>
                            <td>$300.000</td>
                        </tr>
                        <tr>
                            <td>Saldo:</td>
                            <td>$200.000</td>
                        </tr>
                    </table>
                </body>
            </html>';
        
        $pdf = new DOMPDF();
        $pdf->set_paper("A4", "portrait");
        $pdf->load_html(utf8_decode($content));
        $pdf ->render();
        $pdf ->stream('Ejemplo.pdf');
    }
}