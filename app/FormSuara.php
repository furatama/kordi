<?php

namespace App;

use Kris\LaravelFormBuilder\Form;

// class ContactForm extends Form
// {
//     public function buildForm()
//     {
//         $this
//             ->add('tipe', 'select', [
//                 'label' => false,
//                 'choices' => ['telp' => 'No Telepon','wa'=>'No Whatsapp','e@' => 'Email','fb' => 'ID Facebook','ig' => 'ID Instagram','line'=>'ID Line','bbm'=> 'Pin BBM'],
//                 'default_value' => 'telp',
//                 'wrapper' => ['class' => 'form-group col-sm-4 pl-4'],
//                 'attr' => ['class' => 'form-control'],
//             ])
//             ->add('kontak', 'text', [
//                 'label' => false ,
//                 'wrapper' => ['class' => 'form-group col-sm-8'],
//                 'attr' => ['class' => 'form-control'],
//             ]); 
//     }
// }


class FormSuara extends Form
{
    public function buildForm()
    {

        $this->add('idtps', 'select', [
            'label' => 'TPS',
            'attr' => ['id' => 'tps'],
            'choices' => TPS::pluck('nama', 'id')->all(),
            'empty_value' => '== Pilih TPS =='
        ]);

        $this->add('idcaleg', 'select', [
            'label' => 'Caleg',
            'attr' => ['id' => 'caleg'],
            'choices' => Caleg::pluck('nama', 'id')->all(),
            'empty_value' => '== Pilih Caleg =='
        ]);

        $this->add('suara', 'number', [
            'label' => 'Suara',
            // 'wrapper' => ['class' => 'form-group row '],
            'attr' => ['placeholder' => 'Nilai Suara', 'id' => 'suara'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('tglsuara', 'date', [
            'label' => 'Tanggal Suara',
            'attr' => ['placeholder' => 'Tanggal', 'id' => 'tglsuara'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('penanggung', 'text', [
            'label' => 'Penanggung Jawab',
            'attr' => ['placeholder' => 'Penanggung Jawab Suara', 'id' => 'penanggung'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('keterangan', 'textarea', [
            'label' => 'Keterangan',
            'attr' => ['placeholder' => 'Keterangan', 'id' => 'keterangan'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('submit', 'submit', [
            'label' => 'Simpan Data',
            'wrapper' => ['class' => 'float-right'],
            'attr' => ['class' => 'btn btn-success px-5 mr-5']
        ]);
    }
}
