<?php

namespace App\Admin\Controllers;

use App\Models\Immeuble; // Importer le modèle Immeuble
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class ImmeubleController extends AdminController
{
    protected $title = 'Immeubles'; // Mettre à jour le titre

    protected function grid()
    {
        $grid = new Grid(new Immeuble());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('address', __('Address'));
        $grid->column('price', __('Price'));
        $grid->column('description', __('Description'));
        $grid->column('picture')->image();
        $grid->column('rooms', __('Rooms'));
        $grid->column('toilets', __('Toilets'));
        $grid->column('air_conditioning', __('Air Conditioning'));
        $grid->column('heating', __('Heating'));
        $grid->column('ville', __('Ville'));

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
   // Ajouter un filtre par nom seulement
   $grid->filter(function ($filter) {
    $filter->like('name', 'Name'); // Filtre par nom
});
        return $grid;

    }

    public function detail($id)
    {
        $immeuble = Immeuble::findOrFail($id);
        $reservation = $immeuble->reservations()->latest()->first(); // Assuming you have a reservations relationship on Immeuble
        $user = $reservation ? $reservation->user : null; // Fetch the user related to the reservation

        return view('show', compact('immeuble', 'user'));
    }



    protected function form()
    {
        $form = new Form(new Immeuble());

        $form->text('name', __('Name'));
        $form->textarea('address', __('Address'));
        $form->decimal('price', __('Price'));
        $form->textarea('description', __('Description'));
        $form->image('picture', __('Picture'));
        $form->number('rooms', __('Rooms'));
        $form->number('toilets', __('Toilets'));
        $form->switch('heating', __('Heating'))->default(false);
        $form->switch('air_conditioning', __('Air Conditioning'))->default(false);
        $form->select('ville', __('Ville'))->options($this->getTunisianCities());



        return $form;
    }

    protected function getTunisianCities()
{
    return [
        'Ariana' => 'Ariana',
        'Béja' => 'Béja',
        'Ben Arous' => 'Ben Arous',
        'Bizerte' => 'Bizerte',
        'El Kef' => 'El Kef',
        'Gabès' => 'Gabès',
        'Gafsa' => 'Gafsa',
        'Jendouba' => 'Jendouba',
        'Kairouan' => 'Kairouan',
        'Kasserine' => 'Kasserine',
        'Kébili' => 'Kébili',
        'Mahdia' => 'Mahdia',
        'Manouba' => 'Manouba',
        'Medenine' => 'Medenine',
        'Monastir' => 'Monastir',
        'Nabeul' => 'Nabeul',
        'Sfax' => 'Sfax',
        'Sidi Bouzid' => 'Sidi Bouzid',
        'Siliana' => 'Siliana',
        'Sousse' => 'Sousse',
        'Tataouine' => 'Tataouine',
        'Tozeur' => 'Tozeur',
        'Tunis' => 'Tunis',
        'Zaghouan' => 'Zaghouan'
    ];
}

}
