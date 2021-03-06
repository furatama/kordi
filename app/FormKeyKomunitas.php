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


class FormKeyKomunitas extends Form
{
    public function buildForm()
    {

        $this->add('nik', 'text', [
            'label' => 'NIK',
            'attr' => ['placeholder' => 'NIK'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('nama', 'text', [
            'label' => 'Nama',
            'attr' => ['placeholder' => 'Nama'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('komunitas', 'text', [
            'label' => 'Nama Komunitas',
            'attr' => ['placeholder' => 'Nama Komunitas'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('jabatan', 'text', [
            'label' => 'Jabatan',
            'attr' => ['placeholder' => 'Jabatan'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('suara', 'number', [
            'label' => 'Perkiraan Suara',
            'attr' => ['placeholder' => 'Suara'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('keterangan', 'textarea', [
            'label' => 'Catatan',
            'attr' => ['placeholder' => 'Catatan']
        ]);

        $this->add('submit', 'submit', [
            'label' => 'Simpan Data',
            'wrapper' => ['class' => 'float-right'],
            'attr' => ['class' => 'btn btn-success px-5 mr-5']
        ]);
    }
}
