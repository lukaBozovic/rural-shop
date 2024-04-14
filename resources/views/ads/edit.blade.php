<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Izmijeni oglas
            </h2>
        </div>
    </x-slot>
    <div class="px-32 py-4 mx-20">
        <x-splade-form method="put" :default="$ad" :action="route('ads.update',$ad->id)" class="mx-auto p-4 bg-white rounded-md" preserve-scroll>
                    <x-splade-input name="title" label="Naslov" placeholder="Unesite naslov" required/>
                    <x-splade-textarea name="description" label="Opis" placeholder="Unesite opis" autosize />
                    <x-splade-input name="phone_number" label="Broj telefona" placeholder="Unesite broj telefona" required/>
                    <x-splade-input name="city" label="Grad" placeholder="Unesite grad" required/>
                    <x-splade-input name="price" label="Cijena" placeholder="Unesite cijenu" required/>
                    <x-splade-select name="categories[]" label="Kategorije" :options="$categories"
                                     placeholder="Odaberite kategorije" choices multiple relation/>



            <x-splade-file name="cover_image" placeholder="Odaberite sliku"
                           label="Naslovna slika" accept=".jpeg, .png, .jpg, .jfif"/>
            <img v-if="form.cover_image === ''" src="{{config('app.url') . '/' . $ad->coverImage->path}}" alt="" class="w-1/2 mx-auto">
            <img v-if="form.cover_image" :src="form.$fileAsUrl('cover_image')" class="w-1/2 mx-auto">

            <x-splade-file name="images[]" label="Ostale slike" multiple filepond preview accept="image/*"/>

            <x-splade-submit class="mt-4" label="Potvrdi"/>
        </x-splade-form>
    </div>
</x-app-layout>



