<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FuncionesVarias
 *
 * @author jose
 */
class FuncionesVarias {

    //http://www.w3schools.com/php/php_file_upload.asp
    public static function saveImage($url, $fileName) {
        move_uploaded_file($_FILES[$fileName]["tmp_name"], $url);
        return $url;
    }
    
    

}

?>
