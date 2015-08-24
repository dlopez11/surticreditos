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
                    
                    $txt[] = "($id,2," . time() . "," . time() . ",0,'$id','$name','$class','$address','$phone - $celphone','$email','$city')";
                    $text = implode(", ", $txt);
                                        
                }
                
                $sql = "INSERT IGNORE INTO user (idUser, idRole, created, updated, status, password, name, class, address, phone, email, city) VALUES {$text}";
                $result = $this->db->execute($sql); 

                return $this->set_json_response(array('El archivo se importo exitosamente'), 200);                                               
            }
        }
        catch(Exception $e) {
            $this->logger->log("Exception while inserting users: {$e->getMessage()}");
            return $this->set_json_response(array("Ha ocurrido un error, por favor contacte al administrador"), 403);            
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
                $text = array();
                
                while($data = fgetcsv($handle,1000,";","'")){
                    if($data[0]){
                        $values[] = "$data[0]";
                    }
                }
                
                $this->logger->log(print_r($values, true));
                
                foreach ($values as $key => $value) {
                    $c = substr($value, 0, 11);
                    $cu = substr($value, 11, 7);
                    $v = substr($value, 18, 10);
                    $aa = substr($value, 28, 4);
                    $mm = substr($value, 32, 2);
                    $dd = substr($value, 34, 2);
                    $s = substr($value, 36, 10);
                    
                    $ced = ltrim($c,'0');
                    $cue = ltrim($cu,'0');
                    $val = ltrim($v,'0');
                    $sal = ltrim($s,'0');
                    
                    $cedula = trim($ced);
                    $cuenta = trim($cue);
                    $valor = trim($val);
                    $año = trim($aa);
                    $mes = trim($mm);
                    $dia = trim($dd);
                    $saldo = trim($sal);
                    
                    $fecha = "$año-$mes-$dia";
                    
                    $txt[] = "($cuenta,$cedula,'$fecha',$valor,$saldo)";
                    $text = implode(", ", $txt);
                                        
                }                             
                
                $sql = "INSERT IGNORE INTO buy (idBuy, idUser, date, value, balance) VALUES {$text}";
                $result = $this->db->execute($sql);

                return $this->set_json_response(array('El archivo se importo exitosamente'), 200);                                               
            }
        }
        catch(Exception $e) {
            $this->logger->log("Exception while inserting buys: {$e->getMessage()}");
            return $this->set_json_response(array("Ha ocurrido un error, por favor contacte al administrador"), 403);
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
                $text = array();
                
                while($data = fgetcsv($handle,1000,";","'")){
                    if($data[0]){
                        $values[] = "$data[0]";
                    }
                }
                
                $this->logger->log(print_r($values, true));
                
                foreach ($values as $key => $value) {
                    $ce = substr($value, 0, 11);
                    $cu = substr($value, 11, 7);
                    $r = substr($value, 18, 7);
                    $rm = substr($value, 25, 7);
                    $aa = substr($value, 32, 4);
                    $mm = substr($value, 36, 2);
                    $dd = substr($value, 38, 2);
                    $v = substr($value, 40, 11);
                    
                    $ced = ltrim($ce,'0');
                    $cue = ltrim($cu,'0');
                    $rec = ltrim($r,'0');
                    $rem = ltrim($rm,'0');
                    $va = ltrim($v,'0');
                    
                    $cedula = trim($ced);
                    $cuenta = trim($cue);                    
                    $recibo = trim($rec);
                    $valor = trim($va);
                    $año = trim($aa);
                    $mes = trim($mm);
                    $dia = trim($dd);
                    $rmanual = trim($rem);
                    
                    $fecha = "$año-$mes-$dia";
                    
                    $txt[] = "($recibo,$cuenta,$valor,'$fecha')";
                    $text = implode(", ", $txt);
                                        
                }
                
                $this->logger->log(print_r($text, true));
                
                $sql = "INSERT IGNORE INTO payment (idPayment, idBuy, receiptValue, date) VALUES {$text}";
                $result = $this->db->execute($sql);

                return $this->set_json_response(array('El archivo se importo exitosamente'), 200);                                               
            }
        }
        catch(Exception $e) {
            $this->logger->log("Exception while inserting buys: {$e->getMessage()}");
            return $this->set_json_response(array("Ha ocurrido un error, por favor contacte al administrador"), 403);
        }
    }
}