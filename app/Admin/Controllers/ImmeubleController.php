<?php



namespace App\Admin\Controllers;

use App\Models\Immeuble;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class ImmeubleController extends AdminController
{
    protected $title = 'Immeubles';

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
        $grid->column('owner_name', __('Owner Name'));
        $grid->column('owner_prename', __('Owner Prename'));
        $grid->column('owner_phone', __('Owner Phone'));

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        // Filters
        $grid->filter(function ($filter) {
            $filter->like('name', 'Name');
            $filter->like('owner_name', 'Owner Name');
            $filter->like('owner_phone', 'Owner Phone');
        });

        return $grid;
    }

    public function detail($id)
    {
        $immeuble = Immeuble::findOrFail($id);
        $reservation = $immeuble->reservations()->latest()->first();
        $user = $reservation ? $reservation->user : null;

        return view('show', [
            'immeuble' => $immeuble,
            'user' => $user,
            'owner_name' => $immeuble->owner_name,
            'owner_prename' => $immeuble->owner_prename,
            'owner_phone' => $immeuble->owner_phone,
        ]);
    }

    public function purchase(Request $request)
    {
        $purchase = Purchase::create([
            'user_id' => auth()->id(),
            'immeuble_id' => $request->immeuble_id,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('purchase.success', $purchase->id);
    }







    protected function form()
    {
        $form = new Form(new Immeuble());

        $form->text('name', __('Name'))->required();
        $form->textarea('address', __('Address'))->required();
        $form->decimal('price', __('Price'))->required();
        $form->textarea('description', __('Description'));
        $form->image('picture', __('Picture'));
        $form->number('rooms', __('Rooms'))->required();
        $form->number('toilets', __('Toilets'))->required();
        $form->switch('heating', __('Heating'))->default(false);
        $form->switch('air_conditioning', __('Air Conditioning'))->default(false);
        $form->select('ville', __('Ville'))->options($this->getTunisianCities());
        $form->text('owner_name', __('Owner Name'))->required();
        $form->text('owner_prename', __('Owner Prename'))->required();
        $form->text('owner_phone', __('Owner Phone'))->required();

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
            'Zaghouan' => 'Zaghouan',
        ];
    }
}
