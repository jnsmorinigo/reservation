<x-mail::message>
# Employee Schedule for {{ \Carbon\Carbon::parse($date)->toFormattedDateString() }}

Hello {{ $employee->user->name }},

Here is your schedule for {{ \Carbon\Carbon::parse($date)->toFormattedDateString() }}:

@foreach($employee->employeeTimeBlocks->where('work_date', $date) as $block)
- **Time:** {{ $block->start_time }} - {{ $block->end_time }}
  **Status:** @if($block->is_reserved) Reserved @else Available @endif
  <br>
@endforeach

<x-mail::button :url="''">
View More Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
