@extends('layouts.admin')

@section('title', __('rating.rating_client'))
@section('content-header', __('rating.rating_client'))
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card client-list">
        <div class="card-body">
            <table class="table" id="client-table">
                <thead>
                    <tr>
                        <th>{{ __('client.name') }}</th>
                        <th>{{ __('client.email') }}</th>
                        <th>{{ __('client.rating') }}</th>
                        <th>{{ __('client.actions') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr class="client-row" data-client-id="{{ $client->id }}" style="cursor: pointer;">
                            <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                            <td>{{ $client->email }}</td>

                            <td>
                                @if ($client->userToClientRatings->isNotEmpty())
                                    @foreach ($client->userToClientRatings as $rating)
                                        <strong>
                                            <p class="card-text">Rating: {{ $rating->rating }}</p>
                                        </strong>
                                        <strong>
                                            <p class="card-text">Comment: {{ $rating->comment }}</p>
                                        </strong>
                                    @endforeach
                                @else
                                    <p class="card-text">No Rating Yet</p>
                                @endif
                            </td>
                            <td >
                                {{-- <div class=""></div> --}}
                                <form class="form-inline" action="{{ route('rate-clients') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <div class="form-group mr-2">
                                        <label for="rating">Rating:</label>
                                        <input type="number" class="form-control" name="rating" id="rating" min="1" max="5" required>
                                    </div>
                                    <div class="form-group mr-2">
                                        <label for="comment">Comment:</label>
                                        <input class="form-control" name="comment" id="comment" rows="3"></input>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Rating</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- @foreach ($clients as $client)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">Name: {{ $client->first_name }}  {{$client->last_name}}</h2>
                <p class="card-text">Email: {{ $client->email }}</p>
                @if ($client->userToClientRatings->isNotEmpty())
                @foreach ($client->userToClientRatings as $rating)
                <strong><p class="card-text">Rating: {{ $rating->rating }}</p></strong>
                <strong><p class="card-text">Comment: {{ $rating->comment }}</p></strong>
                @endforeach
            @else
                <p class="card-text">No Rating Yet</p>
            @endif
                <form action="{{ route('rate-clients') }}" method="POST">
                    @csrf
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <input type="number" class="form-control" name="rating" id="rating" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <input class="form-control" name="comment" id="comment" rows="3"></input>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Rating</button>
                </form>
            </div>
        </div>
        @endforeach --}}
            {{ $clients->render() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.btn-delete', function() {
                var $this = $(this);

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this pictures!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        // Make an AJAX request to delete the pictures
                        $.ajax({
                            url: $this.data(
                                'url'
                            ), // Assuming data-url attribute contains the delete URL
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}', // Include CSRF token for Laravel
                                // You can include other data if required
                            },
                            success: function(response) {
                                // Handle success, e.g., remove the deleted row from the table
                                $this.closest('tr').fadeOut(500, function() {
                                    $(this).remove();
                                });

                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'The pictures has been deleted.',
                                    'success'
                                );
                            },
                            error: function(xhr, status, error) {
                                // Handle AJAX request error
                                console.error(xhr.responseText);
                                swalWithBootstrapButtons.fire(
                                    'Error!',
                                    'An error occurred while deleting the pictures.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
