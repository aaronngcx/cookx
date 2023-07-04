<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit an Appointment
        </h2>
    </x-slot>
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="mx-5">
                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" required id="name" type="text" placeholder="Name" value="{{ $appointment->name }}">
                  </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Date
                    </label>
                    <div class='form-group input-group date' id='datetimepicker'>
                        <input type='text' name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline date" required class="form-control" value="{{ $appointment->date }}" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                  </div>
                  <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                      Phone
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="phone" required id="password" type="number" placeholder="Phone" value="{{ $appointment->phone }}">
                  </div>
                  <div class="flex items-center justify-center">
                    <input type="text" hidden name="id" value="{{ $appointment->id }}">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                        Submit
                    </button>
                  </div>
                </form>
              </div>
        </div>
    </div>
    
</x-app-layout>

<script>
    $(document).ready(function() {
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
    });

</script>
