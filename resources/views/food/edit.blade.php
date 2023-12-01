<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('food.index') }}">Food</a> &raquo; Edit {{ $item->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's something wrong!
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form class="w-full" action="{{ route('food.update', $item->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Name
                            </label>
                            <input id="name" type="text" placeholder="Food Name" value="{{ old('name') ?? $item->name }}" name="name" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Description
                            </label>
                            <textarea id="description" type="text" placeholder="Food Description" name="description" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500">{{ old('description') ?? $item->description }}</textarea>
                        </div>
                    </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="ingredients" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Ingredients
                            </label>
                            <input id="ingredients" type="text" placeholder="Food Ingredients" value="{{ old('ingredients') ?? $item->ingredients }}" name="ingredients" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500">
                            <p class="text-gray-600 text-xs italic">Separated by commas, for example: <strong>Red Onions, Paprika, Onions, Cucumbers</strong></p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3">
                            <label for="price" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Price
                            </label>
                            <input id="price" type="number" placeholder="Food Price" value="{{ old('price') ?? $item->price }}" name="price" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label for="rate" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Rate
                            </label>
                            <input  id="rate" type="number" max="5" placeholder="Food Rate" value="{{ old('rate') ?? $item->rate }}" name="rate" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="types" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Types
                            </label>
                            <select id="types" name="types" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500">
                                <option value="{{ $item->types }}" selected disabled hidden>{{ $item->types == 'new_food' ? 'New Food' : ucfirst($item->types) }}</option>
                                <option value="recommended">Recommended</option>
                                <option value="popular">Popular</option>
                                <option value="new_food">New Food</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label for="picture-path" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Image
                                </label>
                                <input name="picturePath" id="picture-path" type="file" placeholder="Food Image" class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500">
                            </div>
                        </div>
                        <div>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Image Preview
                            </label>
                            <div class="w-full md:w-2/6 h-56 mb-4 md:mb-0 border ">
                                <img src="{{ $item->picturePath }}" alt="{{ $item->name }}" class="w-full h-full rounded object-cover" id="preview-img">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Update Food
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function readURL(input) {
            console.log('input>>>', input.files[0]);
            if (input.files[0]) {
                let reader = new FileReader();
                
                reader.onload = function (e) {
                    let previewImg = document.getElementById('preview-img');
                    previewImg.src = e.target.result;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        let picturePath = document.getElementById('picture-path');
        picturePath.addEventListener('change', function () {
            readURL(this);
        });
    </script>
</x-app-layout>
