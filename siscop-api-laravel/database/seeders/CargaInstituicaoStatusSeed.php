<?php

namespace Database\Seeders;

use App\Models\InstituicaoStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CargaInstituicaoStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            'Aprovado',
            'Pendente de Aprovação'
        ];

        foreach ($list as $status) {
            InstituicaoStatus::firstOrCreate([
                'nome' => $status,
                'slug' => Str::slug($status)
            ]);
        }
    }
}
