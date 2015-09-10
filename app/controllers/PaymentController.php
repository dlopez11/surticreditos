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
        require_once 'library/pdf/dompdf_config.inc.php';
        
        $content = '
            <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>Ejemplo de Documento en PDF.</title>
                </head>
                <body>
                    <h2>Ingredientes para la realización de Postres.</h2>
                    <p>Ingredientes:</p>
                    <dl>
                        <dt>Chocolate</dt>
                        <dd>Cacao</dd>
                        <dd>Azucar</dd>
                        <dd>Leche</dd>
                        <dt>Caramelo</dt>
                        <dd>Azucar</dd>
                        <dd>Colorantes</dd>
                    </dl>
                </body>
            </html>';
        
        $pdf = new DOMPDF();
        $pdf->set_paper("A4", "portrait");
        $pdf->load_html(utf8_decode($content));
        $pdf ->render();
        $pdf ->stream('Ejemplo.pdf');
    }
}