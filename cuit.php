       function getCUIT($doc_id, $gender){
            if($gender =='' OR $doc_id==''){
                return;
            }
            if (strlen($doc_id)<8){
                $doc_id = '0'.$doc_id;
            }

            if ($gender == 1){
                $prefijo = 20;
            } elseif ( $gender == 2) {
                $prefijo = 27;
            } elseif ($gender =  3) {
                $prefijo = substr($doc_id, 0, 2);
            }


            $cuit = $prefijo.$doc_id;
            $cuit_array = str_split($cuit);
            $verificador = '5432765432';
            $cuit_array = str_split($cuit);
            $verificador_array = str_split($verificador);


            foreach ($cuit_array as $key => $value) {
                $multiplo = $value * $verificador_array[$key];
                $suma = $suma + $multiplo;
            }

            $mod = $suma % 11;
            if ($mod == 0){
                $digito_verificador = 0;
            } else {
                $digito_verificador = 11 - ($suma % 11);
            }

            $cuit = $prefijo.'-'.$doc_id.'-'.$digito_verificador;

            return $cuit;
        }
