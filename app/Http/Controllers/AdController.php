<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Image;
use App\Tables\AdTable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FileUploads\ExistingFile;

class AdController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('ads.index', ['ads' => AdTable::class]);
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('ads.create',
            [
                'categories' => Category::query()->pluck('name', 'id')->toArray()
            ]
        );
    }

    public function store(StoreAdRequest $request): RedirectResponse
    {
        $request['user_id'] = auth()->id();
        $ad = Ad::query()->create($request->except('cover_image', 'images', 'categories', 'images_order'));
        $ad->categories()->attach($request->categories);

        $this->addCoverPhoto($ad, $request);
        if ($request->images) {
            $this->addOtherImages($ad, $request);
        }

        Toast::message("Uspješno kreiran oglas!")->autoDismiss(5);

        return redirect()->route('ads.index');
    }

    private function addCoverPhoto($ad, $request)
    {
        $path = 'storage/' . Storage::putFile('uploads/ads/' . $ad->id, $request->file('cover_image'));
        $img = Image::query()->create([
            'path' => $path,
            'name' => $request->cover_image->getClientOriginalName(),
        ]);
        $ad->update([
            'cover_image_id' => $img->id,
        ]);

    }

    private function addOtherImages($ad, $request)
    {
        foreach ($request->images as $image) {
            $path = 'storage/' . Storage::putFile('uploads/ads/' . $ad->id, $image);
            $img = Image::query()->create([
                'path' => $path,
                'name' => $image->getClientOriginalName(),
            ]);
            $ad->images()->attach($img->id);
        }
    }

    public function update(Ad $ad, UpdateAdRequest $request): RedirectResponse
    {

        $ad->update($request->except('cover_image', 'images', 'categories', 'images_existing', 'images_order'));
        $ad->categories()->sync($request->categories);

        if ($request->cover_image) {
            if ($ad->coverImage()->first()){
                // delete old cover
                Storage::delete(Str::after($ad->coverImage()->first()->path, 'storage/'));
                $ad->coverImage->delete();
                // create new cover
            }
            $this->addCoverPhoto($ad, $request);
        }

        $this->updateOtherImages($ad, $request);

        Toast::message("Uspješno izmijenjen oglas!")->autoDismiss(5);

        return redirect()->route('ads.index');
    }

    public function updateOtherImages($ad, $request)
    {
        $filePaths = [];
        if ($request->images_existing) {
            foreach ($request->images_existing as $fileEncryptedIdentifier) {
                $file = ExistingFile::fromEncryptedString($fileEncryptedIdentifier);
                $filePaths[] = 'storage/' . $file->filename;
            }
        }

        if ($ad->images) {
            foreach ($ad->images as $image) {
                if (!in_array($image->path, $filePaths)) {
                    Storage::delete(Str::after($image->path, 'storage/'));
                    $image->delete();
                }
            }
        }

        //add new images to the images
        if ($request->images) {
            foreach ($request->file('images') as $file) {
                $path = 'storage/' . Storage::putFile('uploads/ads/' . $ad->id, $file);
                $img = Image::query()->create([
                    'path' => $path,
                    'name' => $file->getClientOriginalName()
                ]);
                $ad->images()->attach($img->id);
            }
        }
    }

    public function edit(Ad $ad): View
    {
        $ad->images = $this->getImagesExistingFiles($ad);
        return view('ads.edit', [
            'ad' => $ad,
            'categories' => Category::query()->pluck('name', 'id')->toArray()
        ]);
    }

    private function getImagesExistingFiles($ad): ExistingFile|array
    {
        $images = $ad->images->pluck('path')->toArray();
        $images = array_map(function ($item) {
            return Str::after($item, 'storage/');
        }, $images);
        return ExistingFile::fromDisk('public')->get($images);
    }

    public function destroy(Ad $ad): RedirectResponse
    {
        Storage::delete(Str::after($ad->coverImage->path, 'storage/'));
        $ad->coverImage->delete();
        $ad->images->each(function ($image) {
            Storage::delete(Str::after($image->path, 'storage/'));
            $image->delete();
        });
        $ad->delete();
        return redirect()->back();
    }

    public function changeIsActive(Ad $ad)
    {
        $ad->update([
            'is_active' => !$ad->is_active
        ]);
        return redirect()->back();
    }
}
