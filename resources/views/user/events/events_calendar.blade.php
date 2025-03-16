@extends('layouts.app')

@section('styles')
    <style>
        /* Custom styles for FullCalendar */
        #calendar {
            max-width: 300px; /* Set a maximum width for the calendar */
            margin: 0 auto; /* Center the calendar */
        }

        .fc {
            font-size: 0.9rem; /* Adjust font size for a smaller calendar */
        }

        .fc .fc-daygrid-event {
            background-color: #378006; /* Custom background color for events */
            border: 1px solid #fff; /* Custom border for events */
            color: #fff; /* Text color for events */
            border-radius: 5px; /* Rounded corners for events */
        }

        .fc .fc-daygrid-event:hover {
            background-color: #4caf50; /* Darker shade on hover */
        }

        /* Customize the calendar header */
        .fc-toolbar-title {
            font-size: 1.2rem; /* Decrease title font size */
            font-weight: bold; /* Make title bold */
        }

        /* Adjust the size of the calendar header */
        .fc-toolbar {
            padding: 5px; /* Reduce padding */
        }

        /* Adjust the size of the day cells */
        .fc-daygrid-day {
            height: 60px; /* Set a fixed height for day cells */
        }

        /* Optional: Style for background events */
        .fc .fc-daygrid-event.fc-event-background {
            background-color: #f0f0f0; /* Background color for background events */
            border: none; /* No border for background events */
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        @include('alerts')

        <div class="row mb-3">
            <div class="col-sm-6">
                <h3 class="fw-bold fs-4">Events Calendar</h3>
            </div>
        </div>

        <div class="container-fluid shadow-lg p-4">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5><strong>Event Title:</strong> <span id="eventTitle"></span></h5>
                        <p><strong>Event Description: </strong><span id="eventDescription"></span></p>
                        <p><strong>Location:</strong> <span id="eventLocation"></span></p>
                        <p><strong>Date:</strong> <span id="eventDate"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src='{{ url('plugins/fullcalendar/index.global.js') }}'></script>
    <script src='{{ url('plugins/fullcalendar/index.global.min.js') }}'></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var events = @json($events); // Pass the events to JavaScript

            // Format events for FullCalendar
            var formattedEvents = events.map(event => ({
                title: event.title,
                start: event.date, // Assuming 'date' is in 'Y-m-d' format
                description: event.description,
                location: event.location,
                // Add more fields if necessary
            }));

            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialDate: '{{ date('Y-m-d') }}',
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                events: formattedEvents, // Set the events here
                eventDidMount: function(info) {
                    // Add custom styling or tooltips here
                    info.el.setAttribute('title', info.event.extendedProps.description);
                },
                eventClick: function(info) {
                    // Populate the modal with event details
                    document.getElementById('eventTitle').innerText = info.event.title;
                    document.getElementById('eventDescription').innerText = info.event.extendedProps.description;
                    document.getElementById('eventLocation').innerText = info.event.extendedProps.location;
                    document.getElementById('eventDate').innerText = info.event.start.toLocaleDateString(); // Format date as needed

                    // Show the modal
                    var modal = new bootstrap.Modal(document.getElementById('eventModal'));
                    modal.show();
                }
            });

            calendar.render();
        });
    </script>
@endsection