<?php

namespace App;

use App\AppForm;

class FormKoorL2 extends AppForm
{
    public function buildForm()
    {
        $this->add('idl1', 'select', [
            'label' => 'Koordinator Utama',
            'choices' => KoorL1::pluck('namalengkap', 'id')->all(),
            'empty_value' => '=== Pilih Koordinator Utama ==='
        ]);

        parent::buildForm();
    }
}
