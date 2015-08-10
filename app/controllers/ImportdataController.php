<?php

class ImportdataController extends ControllerBase
{
    public function indexAction()
    {
        
    }
    
    public function importfileoneAction()
    {
        try {
            if ($_FILES['csv']['size'] > 1048576){
                return $this->set_json_response(array('El archivo CSV no puede ser mayor a 1 MB de peso'), 403);
            }
            
            if ($_FILES['csv']['size'] > 0) {

                $fileinfo = pathinfo($_FILES['csv']['name']);
                
                if(strtolower(trim($fileinfo["extension"])) != "csv")
                {
                    return $this->set_json_response(array('Por favor seleccione un archivo de tipo CSV'), 403);
                }
                   
                $csv = $_FILES['csv']['tmp_name'];
                $handle = fopen($csv,'r');
                
                $values = array();
                
                while($data = fgetcsv($handle,1000,";","'")){
                    if($data[0]){
                        $values[] = "($data[0],2," . time() . "," . time() . ",0,$data[0],'$data[1]','Clase','$data[2]',$data[3],'$data[4]','$data[5]')";
                    }
                }
                
                $text = implode(", ", $values); 
                
                $sql = "INSERT INTO user (idUser, idRole, created, updated, status, password, name, class, phone, address, email, city) VALUES {$text}";
                $result = $this->db->execute($sql); 

                return $this->set_json_response(array('El archivo se importo exitosamente'), 200);                                               
            }
        }
        catch(Exception $e) {
            return $this->set_json_response(array($e->getMessage()), 403);            
        }
    }
    
    public function importfiletwoAction()
    {
        try {
            if ($_FILES['csvtwo']['size'] > 1048576){
                return $this->set_json_response(array('El archivo CSV no puede ser mayor a 1 MB de peso'), 403);
            }
            
            if ($_FILES['csvtwo']['size'] > 0) {

                $fileinfo = pathinfo($_FILES['csvtwo']['name']);
                
                if(strtolower(trim($fileinfo["extension"])) != "csv")
                {
                    return $this->set_json_response(array('Por favor seleccione un archivo de tipo CSV'), 403);
                }
                   
                $csv = $_FILES['csvtwo']['tmp_name'];
                $handle = fopen($csv,'r');
                
                $values = array();
                
                while($data = fgetcsv($handle,1000,";","'")){
                    if($data[0]){
                        $values[] = "($data[2],$data[0]," . strtotime($data[4]) . ",'$data[1]',$data[3],$data[5])";
                    }
                }
                
                $text = implode(", ", $values); 
                
                $sql = "INSERT INTO buy (idBuy, idUser, date, name, value, balance) VALUES {$text}";
                $result = $this->db->execute($sql); 

                return $this->set_json_response(array('El archivo se importo exitosamente'), 200);                                               
            }
        }
        catch(Exception $e) {
            return $this->set_json_response(array($e->getMessage()), 403);            
        }
        
    }
    
    public function importfilethreeAction()
    {
        try {
            if ($_FILES['csvthree']['size'] > 1048576){
                return $this->set_json_response(array('El archivo CSV no puede ser mayor a 1 MB de peso'), 403);
            }
            
            if ($_FILES['csvthree']['size'] > 0) {

                $fileinfo = pathinfo($_FILES['csvthree']['name']);
                
                if(strtolower(trim($fileinfo["extension"])) != "csv")
                {
                    return $this->set_json_response(array('Por favor seleccione un archivo de tipo CSV'), 403);
                }
                   
                $csv = $_FILES['csvthree']['tmp_name'];
                $handle = fopen($csv,'r');
                
                $values = array();
                
                while($data = fgetcsv($handle,1000,";","'")){
                    if($data[0]){
                        $values[] = "(null,$data[1],$data[0],$data[2]," . strtotime($data[3]) .")";
                    }
                }
                
                $this->logger->log(print_r($values, true));
                
                $text = implode(", ", $values); 
                
                $this->logger->log(print_r($text, true));
                
                $sql = "INSERT INTO payment (idPayment, idBuy, receiptNumber, receiptValue, date) VALUES {$text}";
                $result = $this->db->execute($sql); 

                return $this->set_json_response(array('El archivo se importo exitosamente'), 200);                                               
            }
        }
        catch(Exception $e) {
            return $this->set_json_response(array($e->getMessage()), 403);            
        }        
    }
}