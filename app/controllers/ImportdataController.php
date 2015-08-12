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
                $txt = array();
                
                while($data = fgetcsv($handle,1000,";","'")){
                    if($data[0]){
                        $values[] = "$data[0]";
                    }
                }
                
                $this->logger->log(print_r($values, true));
                
                foreach ($values as $key => $value) {
                    $c = substr($value, 0, 11);
                    $n = substr($value, 11, 40);
                    $cl = substr($value, 51, 1);
                    $d = substr($value, 52, 30);
                    $t = substr($value, 82, 7);
                    $cel = substr($value, 90, 11);
                    $e = substr($value, 102, 59);                    
                    $ci = substr($value, 163, 5);
                    
                    $id = trim($c);
                    $name = trim($n);
                    $class = trim($cl);
                    $address = trim($d);
                    $phone = trim($t);
                    $celphone = trim($cel);
                    $email = trim($e);
                    $city = trim($ci);
                    
                    $txt[] = "($id,2," . time() . "," . time() . ",0,'$id','$name','$class','$address',$phone,$celphone,'$email','$city')";
                    $text = implode(", ", $txt);
                    
                    $this->logger->log(print_r($text, true));
                }
                
//                $sql = "INSERT INTO user (idUser, idRole, created, updated, status, password, name, class, address, phone, email, city) VALUES {$text}";
//                $result = $this->db->execute($sql); 

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