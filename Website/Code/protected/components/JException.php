<?php

class JException extends Exception {

    public function __toString(){
        echo json_encode(array("status"=>"error","message"=>$this->getMessage()));
        exit();
    }

}
