<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            CookX
        </h2> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="height: 500px;">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="flex">
                        <h1 class="text-2xl font-semibold">Make an Appointment</h1>
                    </div>
                    <div class="mt-8">
                        <div class="flex">
                            <div>
                                <form id="appointment-form" action="{{ route('appointments.store') }}" method="POST">
                                    @csrf
                                    <div class="relative">
                                        <div class='form-group input-group date' id='datetimepicker'>
                                            <input type='text' name="date" required class="form-control" />
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                
                                        <div class="form-group">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-10 w-full rounded">
                                                Book
                                            </button>
                                        </div>
                                    </div>
                                <form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</x-app-layout>
<script>
    $("#datetimepicker").datetimepicker({
    format: "YYYY-MM-DD HH:mm:00",
    stepping: 30,
    timeZone: 'Asia/Singapore',
    disabledTimeIntervals: [
        [moment().startOf('day').hour(0), moment().startOf('day').hour(9)],
        [moment().startOf('day').hour(18), moment().startOf('day').add(1, 'day').hour(9)]
    ],
    enabledHours: [9, 10, 11, 12, 13, 14, 15, 16, 17],
    daysOfWeekDisabled: [0, 6],
    minDate: moment().startOf('day').add(2, 'days'),
    maxDate: moment().startOf('day').add(3, 'weeks')
});

</script>
