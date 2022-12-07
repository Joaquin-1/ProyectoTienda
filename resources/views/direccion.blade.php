<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Add your address') }}
        </h2>
    </x-slot> <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('Add your address') }}
        </h2>
    </x-slot>
    <div class="h-10"></div>
    <form action="{{route('direccion', Auth::user())}}" method="post">
        @csrf
        @method('POST')


        <div class="mb-6 ml-80 w-96 border">
            <label for="calle"
                class="text-xl font-medium text-gray-900 block mb-2 @error('calle') text-red-500 @enderror">
                Street
            </label>
            <input type="text" name="calle" id="calle" required
                class="text-xl w-80 mb-5 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror">



                <label for="ciudad"
                class=" text-xl  font-medium text-gray-900 block mb-2 @error('ciudad') text-red-500 @enderror">
                City
            </label>
            <input type="text" name="ciudad" id="ciudad"
                class="w-80 mb-5 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror">



                <label for="codigo_postal"
                class="text-xl font-medium text-gray-900 block mb-2 @error('codigo_postal') text-red-500 @enderror">
                Postal code
            </label>
            <input type="text" name="codigo_postal" id="codigo_postal"
                class="w-80 mb-5 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror">


                <label for="pais"
                class="text-xl font-medium text-gray-900 block mb-2 @error('pais') text-red-500 @enderror">
                Country
            </label>
            <input type="text" name="pais" id="pais"
                class="w-80  bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 @error('nombre') border-red-500 @enderror">



            <button type="submit"
                class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Set address</button>


            </div>
    </form>

</x-app-layout>
