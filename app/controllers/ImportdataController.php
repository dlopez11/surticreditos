<?php

class ImportdataController extends ControllerBase
{
    public function indexAction()
    {
        
    }
    
    public function importfileoneAction()
    {
        if($this->request->isPost()){
            try {
                $update = $this->request->getPost("update");
                $update = ($update == 'on' ? 1 : 0);
                
                $file = $_FILES['csvone'];
                
                $validateFile = new \Surticreditos\Misc\ValidateFile();
                $validateFile->setFile($file);
                $validateFile->validate();

                $csv = $file['tmp_name'];
                $handle = fopen($csv,'r');

                $values = array();
                $txt = array();

                while($data = fgetcsv($handle,1000,";","'")){
                    if($data[0]){
                        $values[] = "$data[0]";
                    }
                }                                

                foreach ($values as $key => $value) {
                    $c = substr($value, 0, 11);
                    $n = substr($value, 11, 40);
                    $cl = substr($value, 51, 1);
                    $d = substr($value, 52, 30);
                    $t = substr($value, 82, 7);
                    $cel = substr($value, 90, 11);
                    $e = substr($value, 102, 59);                    
                    $ci = substr($value, 163, 5);

                    $ce = ltrim($c,'0');

                    $id = trim($ce);
                    $name = trim($n);
                    $class = trim($cl);
                    $address = trim($d);
                    $phone = trim($t);
                    $celphone = trim($cel);
                    $email = trim($e);
                    $city = trim($ci);

                    if(!empty($ce)){
                        $txt[] = "($id,2," . time() . "," . time() . ",0,'$id','$name','$class','$address','$phone - $celphone','$email','$city')";
                        $text = implode(", ", $txt);
                    }                    
                }

                if(!$update){
                    $sql = "INSERT IGNORE INTO user (idUser, idRole, created, updated, status, password, name, class, address, phone, email, city) VALUES {$text}";                    
                }  
                else {
                    $sql = "INSERT IGNORE INTO user (idUser, idRole, created, updated, status, password, name, class, address, phone, email, city) VALUES {$text} ON DUPLICATE KEY UPDATE updated = VALUES(updated), name = VALUES(name), class = VALUES(class), address = VALUES(address), phone = VALUES(phone), email = VALUES(email), city = VALUES(city)";                   
                } 

                $result = $this->db->execute($sql);

                return $this->set_json_response(array('El archivo se importo exitosamente'), 200);                                               
                
            }
            catch(Exception $e) {
                $this->logger->log("Exception while inserting users: {$e->getMessage()}");
                return $this->set_json_response(array("Ha ocurrido un error, por favor contacte al administrador"), 403);            
            }
        }
    }
    
    public function importfiletwoAction()
    {
        try {
            $file = $_FILES['csvtwo'];
            
            $validateFile = new \Surticreditos\Misc\ValidateFile();
            $validateFile->setFile($file); 
            $validateFile->validate(); 
            $validateFile->formatFileForBuy(); 
            $validateFile->generateFinalFile();
            $validateFile->loadDataOnDb("buy");
             
            return $this->set_json_response(array('El archivo se importo exitosamente'), 200);
        }
        catch(InvalidArgumentException $e) {
            $this->logger->log("Exception while inserting buys: {$e->getMessage()}");
            return $this->set_json_response(array($e->getMessage()), 404);
        }
        catch(Exception $e) {
            $this->logger->log("Exception while inserting buys: {$e->getMessage()}");
            return $this->set_json_response(array("Ha ocurrido un error, por favor contacte al administrador"), 500);
        }                                                
    }
    
    public function importfilethreeAction()
    {
        try {
            $file = $_FILES['csvthree'];
            
            $validateFile = new \Surticreditos\Misc\ValidateFile();
            $validateFile->setFile($file); 
            $validateFile->validate(); 
            $validateFile->formatFileForPayment(); 
            $validateFile->generateFinalFile();
            $validateFile->loadDataOnDb("payment");
             
            return $this->set_json_response(array('El archivo se importo exitosamente'), 200);
        }
        catch(InvalidArgumentException $e) {
            $this->logger->log("Exception while inserting buys: {$e->getMessage()}");
            return $this->set_json_response(array($e->getMessage()), 404);
        }
        catch(Exception $e) {
            $this->logger->log("Exception while inserting buys: {$e->getMessage()}");
            return $this->set_json_response(array("Ha ocurrido un error, por favor contacte al administrador"), 500);
        }
    }
    
    public function importfilefourAction()
    {
        try {
            $file = $_FILES['csvfour'];
            
            $validateFile = new \Surticreditos\Misc\ValidateFile();
            $validateFile->setFile($file); 
            $validateFile->validate(); 
            $validateFile->formatFileForArticle(); 
            $validateFile->generateFinalFile();
            $validateFile->loadDataOnDb("article");
             
            return $this->set_json_response(array('El archivo se importo exitosamente'), 200);
        }
        catch(InvalidArgumentException $e) {
            $this->logger->log("Exception while inserting buys: {$e->getMessage()}");
            return $this->set_json_response(array($e->getMessage()), 404);
        }
        catch(Exception $e) {
            $this->logger->log("Exception while inserting buys: {$e->getMessage()}");
            return $this->set_json_response(array("Ha ocurrido un error, por favor contacte al administrador"), 500);
        }                                         
    }
}