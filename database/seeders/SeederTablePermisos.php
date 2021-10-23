<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Spatie
use Spatie\Permission\Models\Permission;

class SeederTablePermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos=[
            //Operaciones para tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones para tabla empresas
            'ver-empresa',
            'crear-empresa',
            'editar-empresa',
            'borrar-empresa',

             //Operaciones para tabla empresas
             'ver-afianzadora',
             'crear-afianzadora',
             'editar-afianzadora',
             'borrar-afianzadora',

        ];

        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);            
        }
    }
}
