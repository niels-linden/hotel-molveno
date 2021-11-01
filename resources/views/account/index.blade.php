@extends("layouts.app")
@section("title", "Molveno Resort - My Account")
@section("content")
<main>
  <div class="w-full flex flex-col justify-center md:flex-row">
    <div class="flex flex-col lg:flex-row justify-center m-4 pb-32 md:pb-40 md:pt-12">
      @if (auth()->user()->guest)
      <div id="account-create-container" class="w-full md:max-w-4xl">
        @if(Session::has('success'))
        <div class="bg-green-200 border-green-600 text-green-600 border-l-4 p-4" role="alert">
          <p class="font-bold">
            Success
          </p>
          <p>
            {{ Session::get("success") }}
          </p>
        </div>
        @endif
        @error("first_name")
        <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
          <p>
            {{ $message }}
          </p>
        </div>
        @enderror
        @error("last_name")
        <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
          <p>
            {{ $message }}
          </p>
        </div>
        @enderror
        @error("email")
        <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
          <p>
            {{ $message }}
          </p>
        </div>
        @enderror
        @error("address")
        <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
          <p>
            {{ $message }}
          </p>
        </div>
        @enderror
        @error("phone")
        <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
            <p>
                {{ $message }}
            </p>
        </div>
        @enderror

        <form class="flex flex-col justify-evenly" id="update-acc-form" action="{{ route("account.update") }}" method="post">
          @method("patch")
          @csrf
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="first-name" class="block text-sm font-medium text-gray-700">First name <span class="text-red-500">*</span></label>
                  <input type="text" name="first_name" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->first_name : old("first_name") }}" id="first-name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="last-name" class="block text-sm font-medium text-gray-700">Last name <span class="text-red-500">*</span></label>
                  <input type="text" name="last_name" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->last_name : old("last_name") }}" id="last-name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6">
                  <label for="email-address" class="block text-sm font-medium text-gray-700">Email address <span class="text-red-500">*</span></label>
                  <input type="text" name="email" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->email : old("email") }}" id="email-address" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6">
                  <label for="address" class="block text-sm font-medium text-gray-700">Address <span class="text-red-500">*</span></label>       
                  <input type="text" name="address" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->address : old("address") }}" id="autocomplete" placeholder="Choose Location" autocomplete="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6">
                  <label for="phone" class="block text-sm font-medium text-gray-700">Telephone number <span class="text-red-500">*</span></label>
                  <input type="tel" name="phone" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->phone : old("phone") }}" id="telephone" autocomplete="telephone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit"  class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update account
              </button>
            </div>
          </div>
        </form>
      </div>
      @else
      <div class="max-w-xl" id="account-update-container">
        <div class="bg-blue-500 flex items-center text-white text-sm font-bold px-4 py-3 relative mb-2 w-full" role="alert">
            <svg fill="currentColor" class="w-4 h-4 mr-2" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                <path d="M1216 1344v128q0 26-19 45t-45 19h-512q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h64v-384h-64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h384q26 0 45 19t19 45v576h64q26 0 45 19t19 45zm-128-1152v192q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-192q0-26 19-45t45-19h256q26 0 45 19t19 45z">
                </path>
            </svg>
            <p>
                Please complete your account profile
            </p>
        </div>
        @if(Session::has('success'))
        <div class="bg-green-200 border-green-600 text-green-600 border-l-4 p-4" role="alert">
          <p class="font-bold">
            Success
          </p>
          <p>
            {{ Session::get("success") }}
          </p>
        </div>
        @endif

        @error("first_name")
        <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
        <p>
            {{ $message }}
        </p>
        </div>
        @enderror
        @error("last_name")
            <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
            <p>
                {{ $message }}
            </p>
            </div>
        @enderror
        @error("email")
            <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
            <p>
                {{ $message }}
            </p>
            </div>
        @enderror
        @error("address")
            <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
            <p>
                {{ $message }}
            </p>
            </div>
        @enderror
        @error("phone")
        <div class="bg-red-200 border-red-600 text-red-600 border-l-4 p-4 mb-2" role="alert">
            <p>
                {{ $message }}
            </p>
        </div>
        @enderror

        <form class="flex flex-col justify-evenly" id="create-acc-form" action="{{ route("account.create") }}" method="post">
          @csrf
          @if(Session::has('success'))
              <div class="bg-green-200 border-green-600 text-green-600 border-l-4 p-4" role="alert">
              <p class="font-bold">
              Success
              </p>
              <p>
                  {{ Session::get("success") }}
              </p>
          </div>
          @endif

          <div class="shadow overflow-hidden sm:rounded-md">
              <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label for="first-name" class="block text-sm font-medium text-gray-700">First name <span class="text-red-500">*</span></label>
                    <input type="text" name="first_name" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->first_name : old("first_name") }}" id="first-name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
    
                  <div class="col-span-6 sm:col-span-3">
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last name <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->last_name : old("last_name") }}" id="last-name" autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
    
                  <div class="col-span-6">
                    <label for="email-address" class="block text-sm font-medium text-gray-700">Email address <span class="text-red-500">*</span></label>
                    <input type="text" name="email" value="{{ Auth::user()->email }}" id="email-address" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
    
                  <div class="col-span-6">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address <span class="text-red-500">*</span></label>       
                    <input type="text" name="address" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->address : old("address") }}" id="autocomplete" placeholder="Choose Location" autocomplete="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
    
                  <div class="col-span-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Telephone number <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone" value="{{ isset(Auth::user()->guest) ? Auth::user()->guest->phone : old("phone") }}" id="telephone" autocomplete="telephone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit"  class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Update account
                </button>
              </div>
            </div>
        </form>
      </div>
      @endif

          
      <div class="md:max-w-4xl flex flex-col md:ml-4 hidden sm:block">
        <h1 class="text-center my-4 font-medium capitalize text-2xl">Your Reservations</h1>
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table style="width:100%">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Check in
                </th>
              </tr>
              <tr>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Check out
                </th>
              </tr>
              <tr>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Adults
                </th>
              </tr>
              <tr>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Children
                </th>
              </tr>
              <tr>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Roomtype
                </th>
              </tr>
              <tr>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Price
                </th>
              </tr>
              <tr>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Cancel reservation
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @if (!empty($reservations[0]))
              @foreach ($reservations as $reservation)
              <tr>
                <td >
                  <div class="flex items-center justify-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                          {{ $reservation->check_in->format("d-m-Y H:i")}}
                      </div>
                </td>
                <td >
                  <div class="flex items-center justify-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                          {{ $reservation->check_out->format("d-m-Y H:i")}}
                      </div>
                </td>
                <td >
                  <div class="flex items-center justify-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                          {{ $reservation->adults}}
                      </div>
                </td>
                <td>
                  <div class="flex items-center justify-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                          {{ $reservation->children}}
                      </div>
                </td>
                <td >
                  <div class="flex items-center justify-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        Basic
                      </div>
                </td>
                <td >
                  <div class="flex items-center justify-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                          €{{ $reservation->total_price}}
                      </div>
                </td>
                <td >
                  <div class="flex items-center justify-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        @foreach($packages as $package)
                        @if($package->name == "Cancellation insurance")
                        <form action={{ route('booking.destroy', $reservation->id) }} method="POST">
                          @csrf
                          @method('DELETE')
                          <input type="hidden" name="id" value={{$reservation->id}}>
                          <input type="submit" value="Cancel" class="inline-flex justify-center py-1.5 px-6 border border-transparent cursor-pointer shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        </form>
                        @endif
                        @endforeach
                        @if ($package->name == "Cancellation package")
                        <form action={{ route('booking.destroy', $reservation->id) }} method="POST">
                          @csrf
                          @method('DELETE')
                          <input type="hidden" name="id" value={{$reservation->id}}>
                          <input type="submit" value="Cancel" class="inline-flex justify-center py-1.5 px-6 border border-transparent cursor-pointer shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        </form>
                        @endif
                      </div>
                    </div>
                  </div>  
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>

      <div class="md:hidden">
        <h1 class="text-center my-4 font-medium capitalize text-2xl">Your Reservations</h1>
        <table style="width:100%">
          <tr>
            <th class="bg-gray-50">Check in</th>
            <td>Bill Gates</td>
          </tr>
          <tr>
            <th class="bg-gray-50">Check out</th>
            <td>555 77 854</td>
          </tr>
          <tr>
            <th class="bg-gray-50">Adults</th>
            <td>555 77 855</td>
          </tr>
          <tr>
            <th class="bg-gray-50">Children</th>
            <td>555 77 855</td>
          </tr>
          <tr>
            <th class="bg-gray-50">Roomtype</th>
            <td>555 77 855</td>
          </tr>
          <tr>
            <th class="bg-gray-50">Price</th>
            <td>555 77 855</td>
          </tr>
          <tr>
            <th class="bg-gray-50">Cancel reservation</th>
            <td>555 77 855</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</main>

<script>
    $(document).ready(function () {
        $("#latitudeArea").addClass("d-none");
        $("#longtitudeArea").addClass("d-none");
    });
    function addressAutoComplete() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $('#latitude').val(place.geometry['location'].lat());
            $('#longitude').val(place.geometry['location'].lng());
            $("#latitudeArea").removeClass("d-none");
            $("#longtitudeArea").removeClass("d-none");
        });
    }
</script>
@endsection