<?php

namespace App\Classes\CalcTypes;

class CalcTypeValidate
{
    private $types=[ "crcl", "egfr_mdrd", "egfr_ckd_epi", "child_pough_score" ];
    private $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function validate()
    {
        if(in_array($this->type,$this->types))
            return true;
        return  false;
    }
}
