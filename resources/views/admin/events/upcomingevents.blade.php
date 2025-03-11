<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Upcoming Events</h5>
        </div>
        <div class="card-body">
            @if($upcomingEvents->isEmpty())
                <p>No upcoming events found.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Created By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcomingEvents as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->description }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->created_by }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>