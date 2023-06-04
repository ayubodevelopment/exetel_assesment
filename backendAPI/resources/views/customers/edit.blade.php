@extends('app')
 
@section('content')
    <h1>Edit Customer</h1>

    <form id="edit-customer-form" data-id="{{ $customer->id }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" value="{{ $customer->first_name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="{{ $customer->last_name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="{{ $customer->dob }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $customer->email }}" class="form-control" required>
        </div>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('customers.list') }}">Back</a>

    <script>
        $(document).ready(function() {
            $('#edit-customer-form').submit(function(e) {
                e.preventDefault();

                var customerId = $(this).data('id');
                var formData = $(this).serialize();
                $.ajax({
                    url: '/api/customer/' + customerId,
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        // Handle the response and update the UI
                        console.log(response);
                        window.location.href = '/customers';
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection