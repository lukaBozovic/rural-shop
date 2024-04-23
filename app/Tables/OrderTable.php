<?php

namespace App\Tables;

use App\Http\Resources\OrderResource;
use App\Http\Services\RubricService;
use App\Models\Ad;
use App\Models\Category;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class OrderTable extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $orders = Http::get(
            config('app.rural_shop_ordering_url') . '/api/orders?user_id='. auth()->user()->id
        )->json();
        return $orders;
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table): void
    {
        $table
            ->withGlobalSearch(columns: ['id', 'title'])
            ->column('id')
            ->column('ad_id', 'ID oglasa')
            ->column('name', 'Ime')
            ->column('price', 'Cijena')
            ->column('email', 'Email')
            ->column('phone', 'Telefon')
            ->column('is_approved', 'Odobreno', as: function ($is_approved) {
                return $is_approved ? 'Da' : 'Ne';
            })
            ->column('action', 'Akcije',alignment: 'center')
            ->defaultSort('id', 'desc')
        ;

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }

}
