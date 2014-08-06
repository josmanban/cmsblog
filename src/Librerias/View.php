<?php

namespace Librerias;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class View {

    public static function render($path, $data) {
        try {
            if (!is_null($data)) {
                foreach ($data as $key => $value) {
                    $$key = $value;
                }
            }
            require $path;
        } catch (\Exception $e) {
            ob_end_clean();
            //print_r($e);
            echo $e->getMessage();
        }
    }

}

?>
