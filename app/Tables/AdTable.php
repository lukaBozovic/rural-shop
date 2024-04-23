<?php

namespace App\Tables;

use App\Http\Services\RubricService;
use App\Models\Ad;
use App\Models\Category;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class AdTable extends AbstractTable
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
        return Ad::query()->where('user_id', auth()->user()->id)->with(['categories']);
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
            ->column('id', sortable: true)
            ->column('title', 'Naslov', as: function ($title) {
                return Str::limit($title, 40);
            })
            ->column('description', 'Opis', as: function ($description) {
                return Str::limit($description, 40);
            })
            ->column('created_at', 'Kreirano', as: function ($created_at) {
                return $created_at->format('d.m.Y. H:i');
            })
            ->column('price', 'Cijena', as: function ($price) {
                if (is_numeric($price))
                    return number_format($price, 2, ',', '.');
                return $price;
            })
            ->column('phone_number', 'Telefon')
            ->column('city', 'Grad')
            ->column('address', 'Adresa')
            ->column('is_active', 'Aktivno')
            ->column('action', 'Akcije',alignment: 'center')
            ->selectFilter('is_active', [
                1 => 'Da',
                0 => 'Ne',
            ], 'Aktivno', noFilterOptionLabel: 'Odaberite')
            ->selectFilter('categories.id', $this->getCategories(), 'Kategorije', noFilterOptionLabel: 'Odaberite')
            ->defaultSort('id', 'desc')
            ->paginate()
        ;

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }

    protected function getCategories()
    {
        return Category::query()->get()->pluck('name', 'id')->toArray();
    }

}
