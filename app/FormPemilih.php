<?php

namespace App;

use App\AppForm;

class FormPemilih extends AppForm
{
    public function buildForm()
    {
        $this->add('idl2', 'select', [
            'label' => 'Asisten',
            'choices' => KoorL2::pluck('namalengkap', 'id')->all(),
            'empty_value' => '=== Pilih Asisten ==='
        ]);

        parent::buildForm();
    }
}
