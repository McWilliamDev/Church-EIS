@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="bookingModal">Create Event</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('calendar.store') }}">
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Event title">
                        <span id="titleError" class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" rows="3" placeholder="Enter Event description"></textarea>
                        <span id="descriptionError" class="text-danger"></span>
                    </div>
                    
                    <div class="mb-3">
                        <label for="eventLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="eventLocation" placeholder="Enter Event location">
                        <span id="locationError" class="text-danger"></span>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <h3 class="fw-bold fs-4 my-3">Manage Events</h3>
    </div>

    <div class="container-fluid shadow-lg">
        <div class="col-md-12">
            <div id='calendar'></div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src='{{ url('plugins/fullcalendar/index.global.js') }}'></script>
<script src='{{ url('plugins/fullcalendar/index.global.min.js') }}'></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var booking = @json($events);
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            slotMinTime: '08:00',
            slotMaxTime: '20:00',

            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            events: booking,
            selectable: true,
            selectHelper: true,
            select: function(info) {
                $('#bookingModal').modal('toggle');

                $('#saveBtn').off('click').on('click', function() {
                    var title = $('#title').val();
                    var eventDescription = $('#eventDescription').val();
                    var eventLocation = $('#eventLocation').val();
                    var start_date = moment(info.start).format('YYYY-MM-DD');
                    var end_date = moment(info.end).format('YYYY-MM-DD');

                    $.ajax({
                        url: "{{ route('calendar.store') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            title: title,
                            description: eventDescription,
                            location: eventLocation,
                            start_date: start_date,
                            end_date: end_date
                        },
                        success: function(response) {
                            // Add the new event to the calendar
                            calendar.addEvent({
                                title: response.title,
                                description: response.description,
                                location: response.location,
                                start: response.start_date,
                                end: response.end_date
                            });

                            // Close the modal
                            $('#bookingModal').modal('hide');
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                $('#titleError').html(error.responseJSON.errors.title);
                                $('#descriptionError').html(error.responseJSON.errors.description);
                                $('#locationError').html(error.responseJSON.errors.location);
                            }
                        },
                    });
                });
            },
            editable: true,
            eventDrop: function(info) {
                var id = info.event.id;

                if (!id) {
                    console.error('Event ID is missing');
                    return;
                }

                var start_date = moment(info.event.start).format('YYYY-MM-DD');
                var end_date = moment(info.event.end).format('YYYY-MM-DD');

                $.ajax({
                    url: "{{ route('calendar.update', '') }}" + '/' + id,
                    type: "PATCH",
                    dataType: 'json',
                    data: {
                        start_date: start_date,
                        end_date: end_date
                    },
                    success: function(response) {
                        swal("Good job!", "Event Updated!", "success");
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            },
            eventClick: function(info) {
                var id = info.event.id;
                if (confirm('Are you sure you want to delete this event?')) {
                    $.ajax({
                        url: "{{ route('calendar.destroy', '') }}" + '/' + id,
                        type: "DELETE",
                        dataType: 'json',
                        success: function(response) {
                            info.event.remove();
                            swal("Success!", "Event Deleted!", "success");
                        },
                        error: function(error) {
                            console.log(error);
                        },
                    });
                }
            }
        });
        $('#bookingModal').on("hidden.bs.modal",function(){
                $('#saveBtn').unbind();
        });

        calendar.render();
    });
</script>

@endsection
