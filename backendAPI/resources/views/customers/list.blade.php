@extends('app')
 
@section('content')

    <h1 style="color:white">Customers</h1>

    <a style="color:white" href="{{ route('customers.create') }}">Create Customer</a>

    <table id="customer-table" style="color:white">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Email</th>
                <th>Creation Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {

            // Fetch Customers
            function fetchCustomers() {
                $.ajax({
                    url: '/api/customer',
                    method: 'GET',
                    success: function(response) {
                        // Update the customer table
                        var tbody = $('#customer-table tbody');
                        tbody.empty();

                        $.each(response.data, function(index, customer) {
                            var row = $('<tr>');
                            row.append('<td>' + customer.id + '</td>');
                            row.append('<td>' + customer.first_name + '</td>');
                            row.append('<td>' + customer.last_name + '</td>');
                            row.append('<td>' + customer.dob + '</td>');
                            row.append('<td>' + customer.email + '</td>');
                            row.append('<td>' + customer.creation_date + '</td>');
                            row.append(
                                '<td>' +
                                    '<button class="edit-customer" data-id="' + customer.id + '">Edit</button>' +
                                    '<button class="delete-customer" data-id="' + customer.id + '">Delete</button>' +
                                '</td>'
                            );
                            tbody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Initial fetch
            fetchCustomers();

            // Edit Customer
            $(document).on('click', '.edit-customer', function() {
                var customerId = $(this).data('id');
                window.location.href = '/customers/' + customerId + '/edit';
            });

            // Delete Customer
            $(document).on('click', '.delete-customer', function() {
                var customerId = $(this).data('id');
                if (confirm('Are you sure you want to delete this customer?')) {
                    $.ajax({
                        url: '/api/customer/' + customerId,
                        method: 'DELETE',
                        success: function(response) {
                            // console.log(response);
                            alert("Successfully deleted the record");
                            fetchCustomers();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection