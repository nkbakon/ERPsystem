<form wire:submit.prevent="update" method="POST">
    @method('PUT')
    @csrf
    <div>
        <label for="customer">Select Customer</label><br>
        <select name="customer" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" wire:model="invoice.customer_id" required>
            <option value="" disabled selected>Select a customer from here</option>
            @foreach($customers as $customer)
            <option value="{{$customer->id}}">{{$customer->title}}. {{$customer->fname}} {{$customer->lname}} ({{ $customer->district->name }})</option>
            @endforeach
        </select>
    </div>
    @error("invoice.customer_id") <span class="text-red-500 error">{{ $message }}</span><br> @enderror
    <br>
    @foreach ($rows as $index => $row)
        <div>
            <strong class="inline-flex">{{ $index+1 }}.</strong>        
        </div>
        <div>
            <label for="item">Select Item</label><br>
            <select name="item" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" wire:model="item.{{$index}}" disabled>
                <option value="" disabled selected>Select a item from here</option>
                @foreach($all_items as $item)
                <option value="{{$item->id}}">{{$item->code}} - {{ $item->name }} - {{ $item->category->name }} - {{ $item->subcategory->name }}</option>
                @endforeach
            </select>
        </div>
        @error("item.{$index}") <span class="text-red-500 error">{{ $message }}</span><br> @enderror
        <br>
        <div>
            <label for="quantity">Enter Quantity</label><br>
            <input type="number" name="quantity" class="block w-96 appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" wire:model="quantity.{{$index}}" placeholder="quantity" required>
        </div>        
        <br>
    @endforeach
    @error('quantity') <span class="text-red-500 error">{{ $message }}</span><br><br>@enderror
    <br>    
    <h1 class="text-lg text-right text-gray-600"><b>Total Price = {{ $showtotal }}</b></h1>       
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Update</button> 
</form>