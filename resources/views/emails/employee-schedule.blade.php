<x-mail::message>
# Employee Schedule for {{ \Carbon\Carbon::parse($date)->toFormattedDateString() }}

Hello {{ $employee->user->name }},

Here is your schedule for {{ \Carbon\Carbon::parse($date)->toFormattedDateString() }}:

@foreach($employee->employeeTimeBlocks->where('work_date', $date) as $key => $block)
    **Bloque: {{$key + 1}}**
    - **Time in New York:**
      {{
          Carbon\Carbon::createFromFormat('H:i:s', $block->start_time, 'UTC')
              ->setTimezone('America/New_York')
              ->toTimeString()
      }} - {{
          Carbon\Carbon::createFromFormat('H:i:s', $block->end_time, 'UTC')
              ->setTimezone('America/New_York')
              ->toTimeString()
      }}

    - **Time in Employee's Timezone:**
      {{
          Carbon\Carbon::createFromFormat('H:i:s', $block->start_time, 'UTC')
              ->setTimezone($employee->timezone)
              ->toTimeString()
      }} - {{
          Carbon\Carbon::createFromFormat('H:i:s', $block->end_time, 'UTC')
              ->setTimezone($employee->timezone)
              ->toTimeString()
      }}

    - **Status:** @if($block->is_reserved) Reserved @else Available @endif

@endforeach

<x-mail::button :url="''">
View More Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
