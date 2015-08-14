<?php
/**
 * Description of PaginationDecorator
 *
 * @author Will
 */
namespace Surticreditos\Misc;

$path = \Phalcon\DI\FactoryDefault::getDefault()->get('path');
require_once "{$path->path}app/library/phpexcel/PHPExcel.php";

class PHPExcel
{
    private $logger;
    private $path;
    private $data;
    private $report;
    private $phpExcelObj;
    private $user = null;
    private $logo;
    
    public function __construct() 
    {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->path = \Phalcon\DI::getDefault()->get('path');
    }
    
    public function setUser(\User $user)
    {
        $this->user = $user;
    }
    
    public function setData($data)
    {
        $this->data = $data;
    }
    
    public function setLogoDir($logo)
    {
        $this->logo = $logo;
    }
    
    public function create() {
        $this->createExcelObject();

        $preheader = new \stdClass();
        $preheader->name = "Surticreditos";
        $preheader->desc = "Surticreditos 2015";
        $preheader->logo = $this->logo;
        $preheader->x = 10;
        $preheader->y = 20;
        $preheader->coordinates = "A1";
        $preheader->height = 50;
        
        $this->addLogo($preheader);
        
        $firm = array(
            array('key' => 'C1', 'name' => "Número de compra: " . $this->data[0]['code']),
            array('key' => 'C2', 'name' => "Valor total de la compra: ". $this->data[0]['value']),
            array('key' => 'C3', 'name' => "Valor cancelado a la fecha: ". $this->data[0]['dif']),
            array('key' => 'C4', 'name' => "Saldo pendiente a la fecha: ". $this->data[0]['debt']),
        );
        
        $this->createExcelHeader($firm);
        
        
        $header = array(
            array('key' => 'A6', 'name' => "NÚMERO DE RECIBO"),
            array('key' => 'B6', 'name' => "VALOR"),
            array('key' => 'C6', 'name' => "FECHA"),
        );

        $this->createExcelHeader($header);
	
        $row = 7;
        foreach ($this->data[1] as $data) {
            $array = array(
                $data['id'],
                $data['value'],
                $data['date'],
            );

            $this->phpExcelObj->getActiveSheet()->fromArray($array, NULL, "A{$row}");
            unset($array);
            $row++;
        }

        $this->styleExcelHeader('A6:C6');

        $array = array(
            array('key' => 'A', 'size' => 20),
            array('key' => 'B', 'size' => 20),
            array('key' => 'C', 'size' => 35),
        );

        $this->setColumnDimesion($array);
        
        $this->formatUSDNumbers("B7:B{$row}");
        $this->createExcelFile();
    }
    
    private function createExcelObject() {
        // Create new PHPExcel object
        $this->phpExcelObj = new \PHPExcel();
        // Set document properties
        $this->phpExcelObj->getProperties()->setCreator('Sigma Móvil Engine')
                ->setLastModifiedBy('Sigma Móvil Engine')
                ->setTitle("Historial de pagos")
                ->setSubject('Historial de pagos')
                ->setDescription("Historial de pagos realizados por el cliente")
                ->setKeywords('payment history report excel')
                ->setCategory('Report');
    }

    private function createExcelHeader($array) {
        $this->phpExcelObj->setActiveSheetIndex(0);
        foreach ($array as $value) {
            $this->phpExcelObj->getActiveSheet()->setCellValue($value['key'], $value['name']);
        }
    }

    private function styleExcelHeader($fields) {
        $this->phpExcelObj->getActiveSheet()->getStyle($fields)->getFont()->setBold(true);
        $this->phpExcelObj->getActiveSheet()->getStyle($fields)->getAlignment()->setWrapText(TRUE);
        $this->phpExcelObj->getActiveSheet()->getStyle($fields)->getFill()
                ->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()->setARGB('474646');

        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'color' => array('argb' => '00bede'),
                ),
            ),
        );

        $this->phpExcelObj->getActiveSheet()->getStyle($fields)->applyFromArray($styleArray);
        $this->phpExcelObj->getActiveSheet()->getStyle($fields)->getFont()->getColor()->setARGB('FFFFFFFF');
    }

    private function setColumnDimesion($array) {
        foreach ($array as $value) {
            $this->phpExcelObj->getActiveSheet()->getColumnDimension($value['key'])->setWidth($value['size']);
        }
    }

    private function formatUSDNumbers($fields) {
        $this->phpExcelObj->getActiveSheet()->getStyle($fields)->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
//        $this->phpExcelObj->getActiveSheet()->getStyle($fields)->getNumberFormat()->setFormatCode('@');
    }
    
    private function formatPercentageNumbers($fields) {
        $this->phpExcelObj->getActiveSheet()->getStyle($fields)->getNumberFormat()->applyFromArray( 
            array( 
                'code' => \PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00
            )
        );
    }

    private function createExcelFilter($fields) {
        $this->phpExcelObj->getActiveSheet()->setAutoFilter($fields);
    }

    private function addLogo($preheader)
    {
        $objDrawing = new \PHPExcel_Worksheet_Drawing();$objDrawing->setName($preheader->name);
        $objDrawing->setDescription($preheader->desc);
        $objDrawing->setPath($preheader->logo);
        $objDrawing->setOffsetX($preheader->x);    // setOffsetX works properly
        $objDrawing->setOffsetY($preheader->y);  //setOffsetY has no effect
        $objDrawing->setCoordinates($preheader->coordinates);
        $objDrawing->setHeight($preheader->height); // logo height
        $objDrawing->setWorksheet($this->phpExcelObj->getActiveSheet()); 
    }
    
    
    private function createExcelFile() {
        $this->phpExcelObj->setActiveSheetIndex(0);
        $objWriter = \PHPExcel_IOFactory::createWriter($this->phpExcelObj, 'Excel2007');
        $this->saveReport($objWriter);
    }

    private function saveReport($objWriter) {
        $folder = "{$this->path->path}{$this->path->tmpfolder}{$this->user->idUser}/";

        if (!\file_exists($folder)) {
            \mkdir($folder, 0777, true);
        }

        $name = "{$this->user->idUser}-" . date('d-M-Y-His', time()) . "-" . uniqid() . ".xlsx";
        $folder .= $name;
        $objWriter->save($folder);

        $this->report = new \Tmpreport();
        $this->report->idUser = $this->user->idUser;
        $this->report->name = $name;
        $this->report->created = time();

        if (!$this->report->save()) {
            foreach ($this->report->getMessages() as $message) {
                $this->logger->log("Error while saving tmpreport {$message->getMessage()}");
            }
            throw new \Exception("Error while saving tmpreport...");
        }
    }

    public function getReportData() {
        return $this->report;
    }
}