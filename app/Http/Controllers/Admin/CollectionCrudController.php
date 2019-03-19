<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CollectionRequest as StoreRequest;
use App\Http\Requests\CollectionRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class CollectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CollectionCrudController extends CrudController
{
    public function setup()
    {
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
            'name' => 'collecttion-key',
            'label' => 'Clave'
        ]);

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();
        //$this->crud->setColumns(['name', 'active', 'collecttion-key']);


        $this->crud->addField([
            'name' => 'name',
            'type' => 'ajaxtoslug',
            'label' => "Colección",
            'to_slug' => 'collecttion-key'
        ]);

        $this->crud->addField([
           'name' => 'collecttion-key',
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
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
