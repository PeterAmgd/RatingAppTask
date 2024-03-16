@extends('layouts.admin')

@section('title', __('rating.rating_user'))
@section('content-header', __('rating.rating_user'))
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card user-list">
        <div class="card-body">
            <table class="table" id="user-table">
                <thead>
                    <tr>
                        <th>{{ __('user.name') }}</th>
                        <th>{{ __('user.email') }}</th>
                        <th>{{ __('user.rating') }}</th>
                        <th>{{ __('user.actions') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="user-row" data-user-id="{{ $user->id }}" style="cursor: pointer;">
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                @if ($user->clientToUserRatings->isNotEmpty())
                                    @foreach ($user->clientToUserRatings as $rating)
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
                                <form class="form-inline" action="{{ route('rate-users') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
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
            {{-- @foreach ($users as $user)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">Name: {{ $user->first_name }}  {{$user->last_name}}</h2>
                <p class="card-text">Email: {{ $user->email }}</p>
                @if ($user->userTouserRatings->isNotEmpty())
                @foreach ($user->userTouserRatings as $rating)
                <strong><p class="card-text">Rating: {{ $rating->rating }}</p></strong>
                <strong><p class="card-text">Comment: {{ $rating->comment }}</p></strong>
                @endforeach
            @else
                <p class="card-text">No Rating Yet</p>
            @endif
                <form action="{{ route('rate-users') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
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
            {{ $users->render() }}
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
