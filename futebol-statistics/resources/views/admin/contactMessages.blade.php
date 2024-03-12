@extends('layouts.back-layout')

@section('content')

<div class="col-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-2">Messages Table</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Read</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#messageModal{{ $message->id }}" data-message-id="{{ $message->id }}">
                                    {{ $message->id }}
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Details</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>ID: {{ $message->id }}</p>
                                                <p>Name: {{ $message->name }}</p>
                                                <p>Email: {{ $message->email }}</p>
                                                <p>Subject: {{ $message->subject }}</p>
                                                <p>Message: {{ $message->message }}</p>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->message }}</td>
                            <td>
                                @if ($message->is_read)
                                    <span id="badge_{{ $message->id }}" class="badge bg-success">Read</span>
                                @else
                                    <span id="badge_{{ $message->id }}" class="badge bg-warning text-dark">Unread</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>





@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#messageModal{{ $message->id }}').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var messageId = button.data('message-id'); // Extract info from data-* attributes
            markMessageAsRead(messageId);
        });

        function markMessageAsRead(messageId) {
            $.ajax({
                type: 'GET',
                url: '/mark-as-read/' + messageId, // Update the URL according to your route
                success: function(response) {
                    console.log(response); // Log success message
                    // Update UI to reflect read status
                    var badge = $('#badge_' + messageId);
                    if (badge.length) {
                        badge.removeClass('bg-warning text-dark').addClass('bg-success').text('Read');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log error message
                }
            });
        }
    });
</script>