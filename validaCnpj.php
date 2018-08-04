<?php

/*
@author	Renan Venâncio e-mail: renan_1419@hotmail.com

*************************************************************
* Esta função efetua a validação de um CNPJ e retorna um    *
* valor booleano True caso o CNPJ seja válido, ou caso seja *
* inválido retorna False.                                   *
*************************************************************

*/
function validaCnpj($entrada){
    
    $entrada = preg_replace("/\D+/", "", $entrada);   //Remove qualquer mascara do CNPJ
    
    if(strlen($entrada) == 14){    //Verifica se possui 14 digitos

        $invalidos  = array
                       ("0000000000000" ,
                        "1111111111111" ,
                        "2222222222222" ,
                        "3333333333333" ,
                        "4444444444444" ,
                        "5555555555555" ,
                        "6666666666666" ,
                        "7777777777777" ,
                        "8888888888888" ,
                        "9999999999999" );


        if (in_array($entrada, $invalidos)) { return false;     }



        $saida = substr($entrada, 0, strlen($entrada) - 2);   //Retirando os DVs


        function calculaDv($cont, $fimCont, $multiplos, $input){   //Função usada para realizar os calculos

            $soma = 0;

            for($cont; $cont <= $fimCont; $cont++){     
                
                $soma += $input[$cont] * $multiplos;  $multiplos--;

            }  //Fechamento do for
            return $soma;   //Retornando a s
        } //Fechamento da função calculaDv  

            //Passando parametros do calculo para a função interna   
        $dv_um =  calculaDv(0, 3, 5, $saida);             
        $dv_um +=  calculaDv(4, 11, 9, $saida);


        $dv_um = $dv_um % 11;


        if($dv_um <2){    $dv_um = 0;   }else{  $dv_um = 11 - $dv_um;   }

            $saida = $saida . $dv_um; //Concatenando o primeiro DV


        $dv_dois =  calculaDv(0, 4, 6, $saida);
        $dv_dois +=  calculaDv(5, 12, 9, $saida);

        $dv_dois %= 11;


        if($dv_dois <=2){    $dv_dois = 0;   }else{  $dv_dois = 11 - $dv_dois;   }

            $saida = $saida . $dv_dois;   //Concatenando o segundo DV

        if ($entrada != $saida){    return false;   }else{   return true;  }          


    }else{     return false;     }
     
} // Fechamento da função
     
var_dump (validaCnpj("42.391.521/0001-67"));   //<--Esse cnpj é apenas um exemplo, o mesmo foi gerado em um site apenas para teste.

?>
