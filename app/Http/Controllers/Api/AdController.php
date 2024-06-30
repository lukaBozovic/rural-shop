<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdController extends Controller
{
    public function show(Ad $ad)
    {
        return AdResource::make($ad);
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page');
        $categoryId = $request->input('category_id');

        $query = Ad::query()->where('is_active', 1)
            ->with(['coverImage', 'categories', 'unit'])
            ->when($search, function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })->when($categoryId, function ($q) use ($categoryId) {
                $q->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            });

        if ($perPage) {
            $ads = $query->paginate($perPage);
        } else {
            $ads = $query->get();
        }

        return AdResource::collection($ads);
    }
}
