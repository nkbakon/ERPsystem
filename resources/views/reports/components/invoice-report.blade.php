<div class="overflow-x-auto">
    <div id="invoice_report">
        <h1 class="text-center font-bold text-gray-600 text-sm">Invoice Report</h1><br>
        <div class="justify-end">
            &nbsp;<button id="pdf1" title="pdf" class="items-center px-2 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-25">PDF</button>
        </div><br>     
        <table class="w-full text-base text-left text-gray-700 dark:text-gray-400">
            <thead class="text-sm text-gray-800 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="">
                    <th class="py-3 px-6">
                        Invoice No
                    </th>
                    <th class="py-3 px-6">
                        Date
                    </th>
                    <th class="py-3 px-6">
                        Customer
                    </th>
                    <th class="py-3 px-6">
                        District
                    </th>
                    <th class="py-3 px-6">
                        Item Count
                    </th>
                    <th class="py-3 px-6">
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                                    
                    <td class="py-4 px-6">
                        {{ $invoice->id }}
                    </td>               
                    <td class="py-4 px-6">
                        {{ $invoice->created_at->format('Y-m-d') }}                                
                    </td>
                    <td class="py-4 px-6">
                        {{ $invoice->customer->title }}. {{ $invoice->customer->fname }} {{ $invoice->customer->lname }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $invoice->customer->district->name }}
                    </td>  
                    <td class="py-4 px-6">
                        {{ $invoice->totalquantity }}
                    </td>  
                    <td class="py-4 px-6">
                        {{ $invoice->total }}
                    </td>  
                </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</div>

@push('js')
<script>
$("#pdf1").on("click", function () {
    $("#invoice_report").tableHTMLExport({ type: "pdf", filename: "invoice_report.pdf" });
});
</script>
@endpush