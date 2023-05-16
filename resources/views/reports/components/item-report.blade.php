<div class="overflow-x-auto">
    <div id="item_report">
        <h1 class="text-center font-bold text-gray-600 text-sm">Item Report</h1><br>
        <div class="justify-end">
            &nbsp;<button id="pdf3" title="pdf" class="items-center px-2 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">PDF</button>
        </div><br>     
        <table class="w-full text-base text-left text-gray-700 dark:text-gray-400">
            <thead class="text-sm text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="">
                    <th class="py-3 px-6">
                        Item Name
                    </th>
                    <th class="py-3 px-6">
                        Category
                    </th>
                    <th class="py-3 px-6">
                        Sub-Category
                    </th>
                    <th class="py-3 px-6">
                        Quantity
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                                    
                    <td class="py-4 px-6">
                        {{ $item->name }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $item->category->name }}
                    </td>  
                    <td class="py-4 px-6">
                        {{ $item->subcategory->name }}
                    </td>               
                    <td class="py-4 px-6">
                        {{ isset($totalQuantities[$loop->index]) ? $totalQuantities[$loop->index] : 0 }}                                  
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</div>

@push('js')
<script>
$("#pdf3").on("click", function () {
    $("#item_report").tableHTMLExport({ type: "pdf", filename: "item_report.pdf" });
});
</script>
@endpush