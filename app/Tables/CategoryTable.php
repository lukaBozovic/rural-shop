<?php

namespace App\Tables;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class CategoryTable extends AbstractTable
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
        return Category::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id', 'name'])
            ->column('id', sortable: true)
            ->column('name', 'Ime', as : function ($content) {
                return Str::limit($content, 40);
            })
            ->column('action', 'Akcije',alignment: 'center')
            ->defaultSort('id', 'desc')
            ->paginate()
        ;
    }
}
