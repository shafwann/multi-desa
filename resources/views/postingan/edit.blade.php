@extends('layouts.dashboard')

@section('container')
<div class="p-4 mt-16 sm:ml-64">
    <p class="text-3xl font-bold text-blue-600 uppercase">Halaman Edit Editor & Penulis</p>
    <form action="/postingan/{{$postingan->id}}" method="post" class="max-w-xl" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-5">
            <x-label for="judul">Media</x-label>
            <input type="text" id="judul" value="{{$postingan->judul}}" name="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <!-- <div class="mb-5">
            <label for="isi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Isi</label>
            <input type="text" id="isi" name="isi" value="{{$postingan->isi}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div> -->

        <div class="mb-5">
            <x-label for="isi">Media</x-label>
            <input id="isi" type="hidden" name="isi" value="{{$postingan->isi}}" required>
            <trix-editor input="isi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></trix-editor>
        </div>

        <div>
            <x-label for="kategori_id">Media</x-label>
            <select id="kategori_id" name="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach ($kategori as $item)
                <option value="{{ $item->id }}" {{ $item->id === $postingan->kategori_id ? 'selected' : '' }}>
                    {{ $item->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="w-full flex flex-col">
            <div class="mb-3">
                <x-label for="media">Media</x-label>
                <input class="" type="file" name="image">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,ogg,qt|max:20000</p>
            </div>
            <div class="px-4 py-3">
                <img src="{{ asset($postingan->gambar) }}" alt="{{ $postingan->judul }}" class="w-20 h-20 object-cover">
            </div>

            <div class="flex items-center gap-x-4">
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-4 text-center dark:bg-blue-600 dark:hover:bg-blue-800 dark:focus:ring-blue-800">Submit</button>
                <div class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-4 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    <a href="javascript:history.back()">Back</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
