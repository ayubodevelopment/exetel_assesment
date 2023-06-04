@extends('app')
 
@section('content')
    <h1 style="color:white">Create Customer</h1>

    <form style="color:white" id="create-customer-form">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>

        <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>

        <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" id="dob" class="form-control" required>
        </div>

        <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>

    <a style="color:white" href="{{ route('customers.list') }}">Back</a>

    <script>
        $(document).ready(function() {
            $('#create-customer-form').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                $.ajax({
                    url: '/api/customer',
                    method: 'POST',
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