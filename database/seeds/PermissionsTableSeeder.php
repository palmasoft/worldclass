<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usuarios
        Permission::create([
            'name' => 'Ver Usuarios.',
            'slug' => 'user.index',
            'description' => 'Ver usuarios del Sistema.',
        ]);

        //roles
        Permission::create([
            'name' => 'Ver Roles.',
            'slug' => 'role.index',
            'description' => 'Ver Roles del Sistema.',
        ]);

        //Contratos
        Permission::create([
            'name' => 'Ver Contratos.',
            'slug' => 'contrato.index',
            'description' => 'Ver todos los Contratos.',
        ]);

        Permission::create([
            'name' => 'Crear Contrato.',
            'slug' => 'contrato.store',
            'description' => 'Crear un nuevo Contrato.',
        ]);

        //invitados
        Permission::create([
            'name' => 'Crear Invitado.',
            'slug' => 'invitado.store',
            'description' => 'Crear un nuevo Invitado.',
        ]);

        Permission::create([
            'name' => 'Ver Invitados Hoy.',
            'slug' => 'invitado.index',
            'description' => 'Ver todos los Invitados de hoy.',
        ]);

        Permission::create([
            'name' => 'Ver Citas Pasadas/Proximas.',
            'slug' => 'invitado.index2',
            'description' => 'Ver todas las citas pasadas y futuras.',
        ]);

        Permission::create([
            'name' => 'Ver Citas Canceladas.',
            'slug' => 'invitado.index3',
            'description' => 'Ver todas las Citas Canceladas.',
        ]);

        Permission::create([
            'name' => 'Ver Lista Negra.',
            'slug' => 'invitado.index4',
            'description' => 'Ver la Lista Negra.',
        ]);

        //Cartera
        Permission::create([
            'name' => 'Ver Cartera.',
            'slug' => 'cartera.index',
            'description' => 'Ver toda la Cartera.',
        ]);

        //Nomina
        Permission::create([
            'name' => 'Ver nomina.',
            'slug' => 'nomina.index',
            'description' => 'Ver toda la nomina.',
        ]);

        //empleados
        Permission::create([
            'name' => 'Ver Empleados.',
            'slug' => 'empleado.index',
            'description' => 'Ver todos los Empleados.',
        ]);

        //afiliados
        Permission::create([
            'name' => 'Ver Afiliados.',
            'slug' => 'afiliado',
            'description' => 'Ver todos los Afiliados.',
        ]);

        //Foro
        Permission::create([
            'name' => 'Ver Foro.',
            'slug' => 'foro',
            'description' => 'Ver el Foro de soporte.',
        ]);

        //Configuracion
        Permission::create([
            'name' => 'Ver configuracion.',
            'slug' => 'configuracion',
            'description' => 'Ver configuracion.',
        ]);

        //cargos
        Permission::create([
            'name' => 'Ver cargos.',
            'slug' => 'cargo.index',
            'description' => 'Ver todos los cargos.',
        ]);

        //////////////////////////////////

        ////////////////////////////


        //Sedes
        Permission::create([
            'name' => 'Crear sede.',
            'slug' => 'sede.store',
            'description' => 'Crea una Nueva Sede.',
        ]);
        
        Permission::create([
            'name' => 'Actualizar sede.',
            'slug' => 'sede.update',
            'description' => 'Actualiza una Sede.',
        ]);
        
        Permission::create([
            'name' => 'Eliminar sede.',
            'slug' => 'sede.destroy',
            'description' => 'Elimina una Sede.',
        ]);

        //Bonos
        Permission::create([
            'name' => 'Crear bono.',
            'slug' => 'bono.store',
            'description' => 'Crea un Nuevo bono.',
        ]);
        
        Permission::create([
            'name' => 'Actualizar bono.',
            'slug' => 'bono.update',
            'description' => 'Actualiza un bono.',
        ]);
        
        Permission::create([
            'name' => 'Eliminar bono.',
            'slug' => 'bono.destroy',
            'description' => 'Elimina un bono.',
        ]);

        //Servicios
        Permission::create([
            'name' => 'Crear servicio.',
            'slug' => 'servicio.store',
            'description' => 'Crea un Nuevo servicio.',
        ]);
        
        Permission::create([
            'name' => 'Actualizar servicio.',
            'slug' => 'servicio.update',
            'description' => 'Actualiza un servicio.',
        ]);
        
        Permission::create([
            'name' => 'Eliminar servicio.',
            'slug' => 'servicio.destroy',
            'description' => 'Elimina un servicio.',
        ]);
        
        //Cargos
        Permission::create([
            'name' => 'Crear cargo.',
            'slug' => 'cargo.store',
            'description' => 'Crea un Nuevo cargo.',
        ]);
        
        Permission::create([
            'name' => 'Actualizar cargo.',
            'slug' => 'cargo.update',
            'description' => 'Actualiza un cargo.',
        ]);
        
        Permission::create([
            'name' => 'Eliminar cargo.',
            'slug' => 'cargo.destroy',
            'description' => 'Elimina un cargo.',
        ]);
        
        //Empleados
        Permission::create([
            'name' => 'Crear empleado.',
            'slug' => 'empleado.store',
            'description' => 'Crea un Nuevo empleado.',
        ]);
        
        Permission::create([
            'name' => 'Actualizar empleado.',
            'slug' => 'empleado.update',
            'description' => 'Actualiza un empleado.',
        ]);
        
        Permission::create([
            'name' => 'Eliminar empleado.',
            'slug' => 'empleado.destroy',
            'description' => 'Elimina un empleado.',
        ]);
        
        Permission::create([
            'name' => 'Asignar cargo.',
            'slug' => 'empleado.cargo',
            'description' => 'Asigna cargos al empleado.',
        ]);
        
        //Cartera
        Permission::create([
            'name' => 'Agregar Pago(Cartera).',
            'slug' => 'cartera.pago',
            'description' => 'Agrega un pago a un contrato desde cartera.',
        ]);
        
        Permission::create([
            'name' => 'Comentar cartera.',
            'slug' => 'cartera.comentario',
            'description' => 'Agregar un comentario en cartera.',
        ]);

        //Invitados
        Permission::create([
            'name' => 'Confirmar Cita.',
            'slug' => 'invitado.confirmar',
            'description' => 'Confirmar cita del invitado.',
        ]);
        
        Permission::create([
            'name' => 'Rastrear Cita.',
            'slug' => 'invitado.rastrear',
            'description' => 'Rastrear invitado.',
        ]);
        
        Permission::create([
            'name' => 'calificar Cita.',
            'slug' => 'invitado.calificar',
            'description' => 'calificar cita del invitado.',
        ]);
        
        Permission::create([
            'name' => 'Tarjetas del Invitado.',
            'slug' => 'invitado.tarjetas',
            'description' => 'Ver tarjetas del invitado.',
        ]);
        
        Permission::create([
            'name' => 'Agregar Comerciales del Invitado.',
            'slug' => 'invitado.comerciales',
            'description' => 'Agrega comerciales al invitado.',
        ]);

        //Contratos
        Permission::create([
            'name' => 'Eliminar Contrato.',
            'slug' => 'contrato.destroy',
            'description' => 'Elimina un Contrato.',
        ]);

        Permission::create([
            'name' => 'Cambiar Valor de Contrato.',
            'slug' => 'contrato.update',
            'description' => 'Cambia el Valor de un Contrato.',
        ]);
        
        Permission::create([
            'name' => 'Activar/Anular Contrato.',
            'slug' => 'contrato.anular',
            'description' => 'Cambia el estado de servicio de un Contrato, entre activo o anulado.',
        ]);
        
        Permission::create([
            'name' => 'Anular Contrato por CM / ED.',
            'slug' => 'contrato.anular.cm',
            'description' => 'Cambia el estado de servicio de un Contrato, entre activo o anulado.',
        ]);
        
        Permission::create([
            'name' => 'Cambiar Consecutivo de Contrato.',
            'slug' => 'contrato.consecutivo',
            'description' => 'Cambia el Consecutivo de un Contrato.',
        ]);
        
        Permission::create([
            'name' => 'Asignar el numero de factura de un Contrato.',
            'slug' => 'contrato.factura',
            'description' => 'Asigna el numero de factura de un Contrato.',
        ]);
        
        Permission::create([
            'name' => 'Asignar comerciales a un Contrato.',
            'slug' => 'contrato.comerciales',
            'description' => 'Asigna comerciales a un Contrato.',
        ]);
        
        Permission::create([
            'name' => 'Agregar un comentario a un Contrato.',
            'slug' => 'contrato.comentario',
            'description' => 'Agregar un comentario a un Contrato.',
        ]);
        
        Permission::create([
            'name' => 'Editar Titulares/Cotitulares de un Contrato.',
            'slug' => 'contrato.titular',
            'description' => 'Edita los datos del Titular y Cotitular de un Contrato.',
        ]);
        
        Permission::create([
            'name' => 'Upgrade/Downgrade a un Contrato.',
            'slug' => 'contrato.upgrade',
            'description' => 'Upgrade/Downgrade a un Contrato.',
        ]);
        
        //Productos
        Permission::create([
            'name' => 'Crear producto.',
            'slug' => 'producto.store',
            'description' => 'Crea un Nuevo producto.',
        ]);
        
        Permission::create([
            'name' => 'Actualizar producto.',
            'slug' => 'producto.update',
            'description' => 'Actualiza un producto.',
        ]);
        
        Permission::create([
            'name' => 'Eliminar producto.',
            'slug' => 'producto.destroy',
            'description' => 'Elimina un producto.',
        ]);

        //otros
        Permission::create([
            'name' => 'Ver Manifiesto.',
            'slug' => 'manifiesto.view',
            'description' => 'Ver Manifiesto.',
        ]);
        
        Permission::create([
            'name' => 'Enviar Manifiesto.',
            'slug' => 'manifiesto.send',
            'description' => 'Enviar Manifiesto.',
        ]);
    }
}
