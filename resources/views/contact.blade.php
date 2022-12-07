<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight">
            {{ __('CONTACT') }}
        </h2>
    </x-slot>
    <section class="mb-56 text-center text-gray-800 ">
        <div class="max-w-[700px] mx-auto px-3 lg:px-6 mt-24 ">
          <h2 class="text-3xl font-bold mt-6 mb-12">Contact us!</h2>
          <form>
            <div class="form-group mb-6">
              <input type="text" required class="form-control block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput7"
                placeholder="Name">
            </div>
            <div class="form-group mb-6">
              <input type="email" required class="form-control block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput8"
                placeholder="Email address">
            </div>
            <div class="form-group mb-6">
              <textarea required class="
                form-control
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
              " id="exampleFormControlTextarea13" rows="3" placeholder="Message"></textarea>
            </div>

            <button type="submit" class="
              w-full
              px-6
              py-2.5
              bg-orange-600
              text-white
              font-medium
              text-xs
              leading-tight
              uppercase
              rounded
              shadow-md
              hover:bg-orange-700 hover:shadow-lg
              focus:bg-orange-700 focus:shadow-lg focus:outline-none focus:ring-0
              active:bg-orange-700 active:shadow-lg
              transition
              duration-150
              ease-in-out">Send</button>
          </form>
        </div>
      </section>
      <!-- Section: Design Block -->

    </div>


</x-app-layout>
