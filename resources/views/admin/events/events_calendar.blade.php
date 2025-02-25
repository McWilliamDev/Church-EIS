@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        @include('alerts')
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Events Calendar</h3>
        </div>

        <div class="container-fluid shadow-lg">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src='{{ url('plugins/fullcalendar/index.global.js') }}'></script>
<script src='{{ url('plugins/fullcalendar/index.global.min.js') }}'></script>
<script type="text/javascript">
    var calendarEl = document.getElementById('calendar');
    var events = @json($events); // Pass the events to JavaScript
            themeSystem: 'bootstrap5'

    

    // Format events for FullCalendar
    var formattedEvents = events.map(event => {
        return {
            title: event.title,
            start: event.date, // Assuming 'date' is in 'Y-m-d' format
            description: event.description,
            location: event.location,
            // Add more fields if necessary
        };
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            
        },
        initialDate: '<?=date('Y-m-d')?>',
        navLinks: true,
        editable: false,
        events: formattedEvents // Set the events here
    });

    calendar.render();
</script>
@endsection