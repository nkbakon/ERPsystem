<div class="overflow-x-auto">
    <form wire:submit.prevent="select" method="POST">
        @csrf
        <div  class="flex w-full p-3 space-x-2">
            <div date-rangepicker class="flex items-center">
                <span class="mx-4 text-gray-500">from</span>
                <div class="relative">
                    <input name="start_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start" wire:model="start_date" required>
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div class="relative">
                    <input name="end_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end" wire:model="end_date" required>
                </div>
            </div>&nbsp;&nbsp;            
            <div>
                &nbsp;&nbsp;&nbsp;<button wire:target="select" wire:loading.attr="disabled" type="submit" title="show" class="items-center px-3 py-3 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">Show Report</button>
            </div>            
        </div>
        @error('start_date') <span class="text-center text-red-500 error">{{ $message }}</span><br> @enderror
        @error('end_date') <span class="text-center text-red-500 error">{{ $message }}</span><br> @enderror
    </form>
    @if ($selected_date1 && $selected_date2)
        <br>
        <h1 class="text-center text-lg text-gray-600 dark:text-gray-400">From: {{ $selected_date1 }}</h1>
        <h1 class="text-center text-lg text-gray-600 dark:text-gray-400">To: {{ $selected_date2 }}</h1><br>
        <livewire:reports.invoice-report :selected_date1=$selected_date1 :selected_date2=$selected_date2 /><br><br>
        <livewire:reports.invoiceitem-report :selected_date1=$selected_date1 :selected_date2=$selected_date2 /><br><br> 
        <livewire:reports.item-report :selected_date1=$selected_date1 :selected_date2=$selected_date2 /><br><br>      
    @else
    <h1 class="text-center text-lg text-red-500 dark:text-red-400">Select a date range</h1>
    @endif   
<br>

</div>