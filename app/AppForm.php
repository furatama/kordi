<?php

namespace App;

use Kris\LaravelFormBuilder\Form;

class ContactForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('tipe', 'select', [
                'label' => false,
                'choices' => ['telp' => 'No Telepon','wa'=>'No Whatsapp','e@' => 'Email','fb' => 'ID Facebook','ig' => 'ID Instagram','line'=>'ID Line','bbm'=> 'Pin BBM'],
                'default_value' => 'telp',
                'wrapper' => ['class' => 'form-group col-sm-4 pl-4'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('kontak', 'text', [
                'label' => false ,
                'wrapper' => ['class' => 'form-group col-sm-8'],
                'attr' => ['class' => 'form-control'],
            ]); 
    }
}


class AppForm extends Form
{
    public function buildForm()
    {

        $this->add('nik', 'text', [
            'label' => 'NIK',
            'attr' => ['placeholder' => 'NIK'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('namalengkap', 'text', [
            'label' => 'Nama Lengkap',
            'attr' => ['placeholder' => 'Nama Lengkap'],
            'errors' => ['class' => 'text-danger col-md-8 offset-md-3'],
        ]);

        $this->add('jeniskelamin', 'choice', [
            'label' => 'Jenis Kelamin',
            'choices' => ['L' => 'Laki-Laki', 'P' => 'Perempuan'],
            'expanded' => true,
            'multiple' => false
        ]);

        $this->add('alamat', 'text', [
            'label' => 'Alamat',
            'attr' => ['placeholder' => 'Alamat']
        ]);

        $this->add('iddesa', 'select', [
            'label' => 'Desa',
            'attr' => ['id' => 'desa'],
            'choices' => Desa::pluck('nama', 'id')->all(),
            'empty_value' => '== Pilih Desa =='
        ]);

        $this->add('idbanjar', 'select', [
            'label' => 'Banjar',
            'attr' => ['id' => 'banjar'],
            'choices' => Banjar::pluck('nama', 'id')->all(),
            'empty_value' => '== Pilih Banjar =='
        ]);

        $this->add('idtps', 'select', [
            'label' => 'TPS',
            'attr' => ['id' => 'tps'],
            'choices' => TPS::pluck('nama', 'id')->all(),
            'empty_value' => '== Pilih TPS =='
        ]);

        $this->add('kontak', 'collection', [
            
                'label' => 'Kontak',
                'type' => 'form',
                'wrapper' => ['class' => 'form-group'],
                'label_attr' => ['class'=>'col-sm-2 text-right'],
                'options' => [    // these are options for a single type
                    'class' => 'App\ContactForm',
                    'wrapper' => ['class' => 'col-sm-12 row'],
                    'label' => false,
                ]
            
        ]);

        $this->add('submit', 'submit', [
            'label' => 'Simpan Data',
            'wrapper' => ['class' => 'float-right'],
            'attr' => ['class' => 'btn btn-success px-5 mr-5']
        ]);
    }
}
