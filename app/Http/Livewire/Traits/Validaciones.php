<?php

namespace App\Http\Livewire\Traits;



trait Validaciones{
    /** Valida de forma general la CURP */
    public function validaCURP($curp){
        $regex ="/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}";
        $regex.="(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])";
        $regex.="[HM]{1}";
        $regex.="(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)";
        $regex.= "[B-DF-HJ-NP-TV-Z]{3}";
        $regex.= "[0-9A-Z]{1}[0-9]{1}$";
        $regex.= "/";
        return preg_match($regex, $curp);
    }

    /** Validar de forma general el RFC */
    public function validaRFC($rfc){
        $regex = "/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A]|[0-9]){1})?$/";
        return preg_match($regex, $rfc);
    }
}
