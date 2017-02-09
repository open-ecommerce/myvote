<?php
// klass som används för att generera slumpmässig info till användaren
class RandomInfo {

    private function randomIndex($arr){
        return rand(0, count($arr) - 1);
    }

    //Generea text i popup-rutorna
    public function generateTip($type){
        $suc_info = array(
            "Fantastic: ",
            "Thanks: ",
            "Sweet: "
        );
        $err_info = array(
            "Error voting: ",
        );

        $msg = "";
        if($type == "success"){
            $msg = $suc_info[$this->randomIndex($suc_info)];
        }else if($type == "error"){
            $msg = $err_info[$this->randomIndex($err_info)];
        }
        return $msg;
    }


}


 ?>
