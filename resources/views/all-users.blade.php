<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Opertaion</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <div class="container mt-4" >
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-primary mb-4 text-center">
                <h4>All users </h4>
                </div>

                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Country</th>
                        <th scope="col">State</th>
                        <th scope="col">City</th>
                        <th scope="col">Adress</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if(count($users) > 0)
                        @foreach($users as $user)
                      <tr>
                        <th scope="row">1</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ asset('storage/app/public/uploads/' . $user->image ?? 'default-image.jpg') }}" height="20px" width="20px"></td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->country }}</td>
                        <td>{{ $user->state }}</td>
                        <td>{{ $user->city }}</td>
                        <td>{{ $user->address }}</td>
                        <td><a href="" class="btn btn-warning">Edit</a>&nbsp<a href="{{ url('delete-user/'.$user->id) }}" class="btn btn-danger">Delete</a></td>
                      </tr>
                      @endforeach
                      @else
                      <tr colspan="10">
                        <td colspan="10" style="text-align: center;">No record found....</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
            </div>
        <div>
    </div>
   
<html>