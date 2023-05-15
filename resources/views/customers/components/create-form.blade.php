<form wire:submit.prevent="store" method="POST">
    @csrf
    <div>
        <label for="title">Title</label><br>
        <select name="title" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" wire:model="title" required>
            <option value="" disabled selected>Select a title from here</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select> 
    </div>
    @error('title') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
    <br>
    <div>
        <label for="fname">First Name</label><br>
        <input type="text" name="fname" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="first name" wire:model="fname" required>
    </div>
    @error('fname') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
    <br>
    <div>
        <label for="lname">Last Name</label><br>
        <input type="text" name="lname" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="last name" wire:model="lname" required>
    </div>
    @error('lname') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
    <br>
    <div>
        <label for="contact">Contact Number</label><br>
        <input type="text" name="contact" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="contact number" wire:model="contact" required>
    </div>
    @error('contact') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
    <br>
    <div>
        <label for="district">District</label><br>
        <select name="district" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" wire:model="district" required>
            <option value="" disabled selected>Select a district from here</option>
            @foreach($districts as $district)
            <option value="{{$district->id}}">{{$district->name}}</option>
            @endforeach
        </select> 
    </div>
    @error('district') <span class="text-red-500 error">{{ $message }}</span><br> @enderror
    <br>
    <button wire:target="store" wire:loading.attr="disabled" type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">Save</button>                        
</form>