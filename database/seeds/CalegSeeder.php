<?php

use Illuminate\Database\Seeder;

class CalegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $table->unsignedInteger('idpartai')->nullable();

        //     $table->unsignedInteger('nourut');
        //     $table->string('nama');
        //     $table->string('foto')->nullable();
        //     $table->softDeletes();
        //     $table->timestamps();


        //
    		DB::table('caleg')->insert([
                [
                    'idpartai' => 1,
                    'nourut' => 1,
                    'nama' => "H. Sunoto",
                    'foto' => "",
                ],
                [
                    'idpartai' => 1,
                    'nourut' => 2,
                    'nama' => "H. Djoko Supriono",
                    'foto' => "",
                ],
                [
                    'idpartai' => 1,
                    'nourut' => 3,
                    'nama' => "Imronah, S.Pd.I",
                    'foto' => "",
                ],
        ]);
    }
}