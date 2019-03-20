<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CollectionRequest as StoreRequest;
use App\Http\Requests\CollectionRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Spatie\Permission\Models\Permission;

/**
 * Class CollectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CollectionCrudController extends CrudController
{
    public function setup()
    {
        $this->request->flashOnly(['collectionkey']);
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */

        $this->crud->setModel('App\Models\Collection');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/collection');
        $this->crud->setEntityNameStrings('collection', 'collections');

        $this->crud->setTitle('Colecciones');
        $this->crud->setHeading('Colecciones');

        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre'
        ]);

        $this->crud->addColumn([
            'name' => 'collecttionkey',
            'label' => 'Clave'
        ]);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();
        $this->crud->enableExportButtons();

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();
        //$this->crud->setColumns(['name', 'active', 'collecttion-key']);


        $this->crud->addField([
            'name' => 'name',
            'type' => 'ajaxtoslug',
            'label' => "Colección",
            'to_slug' => 'collecttionkey'
        ]);

        $this->crud->addField([
           'name' => 'collecttionkey',
           'type' => 'text',
           'label' => 'Clave',
           'hint' => 'Este campo se autocompletara desde el Nombre de Colección. O ingrese su propia key'
        ]);

        $this->crud->addField([
                    'name' => 'active',
                    'label' => 'Activa',
                    'type' => 'checkbox'
        ]);
       // $this->crud->enableAjaxTable();
        // add asterisk for fields that are required in CollectionRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        Permission::create(['name' => $this->crud->entry->collecttionkey, 'guard_name' => 'web']);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {

        //TODO  :: BUSCAR Y CAMBIAR PERMISO
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
