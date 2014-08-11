<?php

namespace Librerias;

use JBBCode\Parser;
use JBBCode\DefaultCodeDefinitionSet;
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

    public static function getHtml($bbcode) {


        $parser = new Parser();
        $parser->addCodeDefinitionSet(new DefaultCodeDefinitionSet());

        $parser->parse($bbcode);

        return $parser->getAsHtml();
    }

}

?>
