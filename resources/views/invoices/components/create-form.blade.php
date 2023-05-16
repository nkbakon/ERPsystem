<form wire:submit.prevent="store" method="POST">
    @csrf
    <div>
        <label for="customer">Select Customer</label><br>
        <select name="customer" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" wire:model="customer" required>
            <option value="" disabled selected>Select a customer from here</option>
            @foreach($customers as $customer)
            <option value="{{$customer->id}}">{{$customer->title}}. {{$customer->fname}} {{$customer->lname}} ({{ $customer->district->name }})</option>
            @endforeach
        </select>
    </div>
    @error("customer") <span class="text-red-500 error">{{ $message }}</span><br> @enderror
    <br>
    @foreach ($rows as $index => $row)
        <div>
            <strong class="inline-flex">{{ $index+1 }}.</strong>
            <button type="button" wire:click="removeRow({{$index}})" class="inline-flex px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"><i class="fa-solid fa-xmark"></i></button>
        </div><br>
        <div>
            <label for="items">Select Item</label><br>
            <select name="items" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" wire:model="items.{{$index}}" required>
                <option value="" disabled selected>Select a item from here</option>
                @foreach($all_items as $item)
                <option value="{{$item->id}}">{{$item->code}} - {{ $item->name }} - {{ $item->category->name }} - {{ $item->subcategory->name }}</option>
                @endforeach
            </select>
        </div>
        @error("items.{$index}") <span class="text-red-500 error">{{ $message }}</span><br> @enderror
        <br>
        <div>
            <label for="quantities">Enter Quantity</label><br>
            <input type="number" name="quantities" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" wire:model="quantities.{{$index}}" placeholder="enter quantity" required>
        </div>        
        <br>
    @endforeach
    @error("quantities") <span class="text-red-500 error">{{ $message }}</span><br><br>@enderror
    <div>
        <button type="button" wire:click="addRow" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">
            Add Another Item
        </button>
    </div>
    <br>
    <h1 class="text-lg text-right text-gray-600"><b>Total Price = {{ $showtotal }}</b></h1>
    <div>
        <button wire:target="store" wire:loading.attr="disabled" type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">Save</button>
    </div>
</form>