<div class="overflow-x-auto">
    <div id="invoiceitem_report">
        <h1 class="text-center font-bold text-gray-600 text-sm">Invoice Item Report</h1><br>
        <div class="justify-end">
            &nbsp;<button id="pdf2" title="pdf" class="items-center px-2 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">PDF</button>
        </div><br>     
        <table class="w-full text-base text-left text-gray-700 dark:text-gray-400">
            <thead class="text-sm text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="">
                    <th class="py-3 px-4">
                        Invoice No
                    </th>
                    <th class="py-3 px-4">
                        Date
                    </th>
                    <th class="py-3 px-4">
                        Customer
                    </th>
                    <th class="py-3 px-4">
                        Items
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                                    
                    <td class="py-2 px-4">
                        {{ $invoice->id }}
                    </td>               
                    <td class="py-2 px-4">
                        {{ $invoice->created_at->format('Y-m-d') }}                                
                    </td>
                    <td class="py-2 px-4">
                        {{ $invoice->customer->title }}. {{ $invoice->customer->fname }} {{ $invoice->customer->lname }} ({{ $invoice->customer->district->name }})
                    </td>
                    <td class="py-2 px-4">
                        @php
                            $item_ids = json_decode($invoice->item_ids);
                            $prices = json_decode($invoice->prices);
                        @endphp
                        @for ($i = 0; $i < count($item_ids); $i++)
                            {{ App\Models\Item::find($item_ids[$i])->code }} - {{ App\Models\Item::find($item_ids[$i])->name }} - {{ App\Models\Item::find($item_ids[$i])->category->name }} - {{ App\Models\Item::find($item_ids[$i])->subcategory->name }} : {{ $prices[$i] }},<br>
                        @endfor 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</div>

@push('js')
<script>
$("#pdf2").on("click", function () {
    $("#invoiceitem_report").tableHTMLExport({ type: "pdf", filename: "invoice_item_report.pdf" });
});
</script>
@endpush