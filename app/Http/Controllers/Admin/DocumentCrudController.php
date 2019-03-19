<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\DocumentRequest as StoreRequest;
use App\Http\Requests\DocumentRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Illuminate\Support\Str;

/**
 * Class DocumentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DocumentCrudController extends CrudController
{
    public function setup()
    {
        $sUuid = Str::orderedUuid();

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Document');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/document');
        $this->crud->setEntityNameStrings('document', 'documents');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        $this->crud->setTitle('Documentos');
        $this->crud->setHeading('Documentos');

        // add asterisk for fields that are required in DocumentRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Título'
        ]);

        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Descripción'
        ]);

        $this->crud->addColumn([
            'name' => 'file',
            'label' => 'Archivo',
            'limit' => 150
        ]);

        $this->crud->addColumn([
            'name' => 'link',
            'label' => 'Vínculo'
        ]);

        $this->crud->addField([
            'name' => 'title',
            'type' => 'text',
            'label' => "Título",
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'tinymce',
            'label' => 'Descripción',
        ]);

        $this->crud->addField([
            'name' => 'file',
            'label' => 'Archivo',
            'type' => 'browse'
        ]);

        $this->crud->addField([
            'name' => 'link',
            'label' => 'Vínculo',
            'default' => $sUuid,
            'type' => 'text',
            'attributes' => [
                'readonly'=>'readonly',
            ]
]);

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        // add asterisk for fields that are required in DocumentRequest
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
