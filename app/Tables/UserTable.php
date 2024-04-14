<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class UserTable extends AbstractTable
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
        return User::query()->where('is_admin', false);
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
            ->withGlobalSearch(columns: ['id', 'name', 'email'])
            ->column('id', sortable: true)
            ->column('name', 'Ime', as : function ($content) {
                return Str::limit($content, 40);
            })
            ->column('email', 'Email', as : function ($content) {
                return Str::limit($content, 40);
            })
            ->column('created_at', 'Kreirano', as : function ($content) {
                return $content->format('d.m.Y H:i');
            })
            ->column('action', 'Akcije',alignment: 'center')
            ->defaultSort('id', 'desc')
            ->paginate()
        ;
    }
}
