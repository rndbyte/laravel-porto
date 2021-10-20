<div class="grid grid-cols-2 gap-2 border border-gray-200 p-2 rounded">
    <div class="flex border rounded bg-gray-100 items-center p-2">
        <svg class="mr-2 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <input type="text"
               name="from"
               id="input-from"
               value="{{ $from }}"
               placeholder="Период с"
               class="bg-gray-100 max-w-full focus:outline-none text-gray-700"/>
    </div>
    <div class="flex border rounded bg-gray-100 items-center p-2">
        <svg class="mr-2 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <input type="text"
               name="to"
               id="input-to"
               value="{{ $to }}"
               placeholder="Период по"
               class="bg-gray-100 max-w-full focus:outline-none text-gray-700"/>
    </div>
</div>
@push('stack_after_scripts')
    <script>
        let inputFrom = document.getElementById("input-from");
        if (inputFrom !== null) {
            Inputmask({mask: "99.99.9999"}).mask(inputFrom);
        }
        let inputTo = document.getElementById("input-to");
        if (inputTo !== null) {
            Inputmask({mask: "99.99.9999"}).mask(inputTo);
        }
    </script>
@endpush
