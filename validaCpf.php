<?php
/*
@author	Renan Venâncio e-mail: renan_1419@hotmail.com
*************************************************************
* Esta função efetua a validação de um CPF e retorna um    *
* valor booleano True caso o CPF seja válido, ou caso seja *
* inválido retorna False.                                   *
*************************************************************
*/
function validaCpf($entrada){
    
    $entrada = preg_replace("/\D+/", "", $entrada);   //Remove qualquer mascara do cpf
       
    if(strlen($entrada) == 11){    //Se possuir 11 digitos então é um CPF
        $invalidos  = array
            ("00000000000" ,
             "11111111111" ,
             "22222222222" ,
             "33333333333" ,
             "44444444444" ,
             "55555555555" ,
             "66666666666" ,
             "77777777777" ,
             "88888888888" ,
             "99999999999" );
            
            
    if (in_array($entrada, $invalidos)) { 
        return false;
    }

    $mul_um = 10;   //Multiplicador dos 9 primeiros digitos
    $soma_um = 0;   //Soma dos 9 primeiros digitos
    $saidaCpf = ""; //Numero de saida CPF

    for ($i=0; $i<=8; $i++){

        $soma_um += $mul_um * $entrada[$i];
        $mul_um --;
        $saidaCpf = $saidaCpf . $entrada[$i];
    }

    if((($soma_um % 11) == 0) || (($soma_um % 11) == 1)){

        $dv_um = 0;

    }else if ((($soma_um % 11) >= 2) || (($soma_um % 11) <= 10)){

        $dv_um = 11 - ($soma_um % 11);

    } // FIM DO CALCULO DO PRIMEIRO DIGITO

    $saidaCpf = $saidaCpf . $dv_um;    //Concatenando o DV_UM com o CPF


    $mul_dois = 11;   //Multiplicador dos 10 primeiros digitos
    $soma_dois = 0;   //Soma dos 10 primeiros digitos

    for ($j=0; $j<=9; $j++){

        $soma_dois += $mul_dois * $saidaCpf[$j];

        $mul_dois --;

    }

    if((($soma_dois % 11) == 0) || (($soma_dois % 11) == 1)){

        $dv_dois = 0;

    }else if ((($soma_dois % 11) >= 2) || (($soma_dois % 11) <= 10)){

        $dv_dois = 11 - ($soma_dois % 11);

    } // FIM DO CALCULO DO SEGUNDO DIGITO

    $saidaCpf = $saidaCpf . $dv_dois;   //CONCATENANDO O DV_DOIS COM O CPF


    if($entrada != $saidaCpf){ return false;    } else {  return true;  }   //Retornando o booleano true = CPF Válido False = CPF Inválido
    }else{  return false;     }
    
} //Fechando a função

var_dump(validaCpf("347.516.490-60"));
    
?>
