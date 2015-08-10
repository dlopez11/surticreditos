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
                        $values[] = "($data[0],2," . time() . "," . time() . ",0,'$data[0]','$data[1]','Clase','$data[2]','$data[3]',$data[4],'$data[5]')";
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
        
    }
    
    public function importfilethreeAction()
    {
        
    }
}