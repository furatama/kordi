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


class FormPartai extends Form
{
    public function buildForm()
    {

        $this->add('idpartai', 'select', [
            'label' => 'Partai',
            'attr' => ['id' => 'partai'],
            'choices' => Partai::pluck('nama', 'id')->all(),
            'empty_value' => '== Pilih Partai =='
        ]);

        $this->add('nourut', 'number', [
            'label' => 'No Urut',
            'attr' => ['placeholder' => 'No Urut'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('nama', 'text', [
            'label' => 'Nama',
            'attr' => ['placeholder' => 'Nama'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);
        
        $this->add('foto', 'file', [
            'label' => 'Foto',
            'attr' => ['placeholder' => 'Foto'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('submit', 'submit', [
            'label' => 'Simpan Data',
            'wrapper' => ['class' => 'float-right'],
            'attr' => ['class' => 'btn btn-success px-5 mr-5']
        ]);
    }
}
