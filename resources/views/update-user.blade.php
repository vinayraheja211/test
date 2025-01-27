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

<body>
    <div class="container mt-4" >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-primary mb-4 text-center">
                   <h4 >Crud Opertaion</h4>
                </div>
               
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form method="post" action="{{ url('save-user') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $user->id }}" name="id">
                    <div class="form-group mb-3">
                       <label>Name</label>
                       <input type="text" name="name" placeholder="Enter Name" required class="form-control" value="{{ $user->name }}">
                       @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="abc@gmail.com" required class="form-control" value="{{ $user->email }}">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                     </div>

                     <div class="form-group mb-3">
                        <label>Phone</label>
                        <input type="number" name="phone" placeholder="(+91) 97989979889" required class="form-control" value="{{ $user->phone }}">
                        @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                     </div>

                     <div class="form-group mb-3">
                        <label>Address</label>
                        <textarea class="form-control" required value="{{ old('address') }}" name="address">{{ $user->address }}</textarea>
                        @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                     </div>

                     <div class="form-group mb-3">
                        <label>Image</label>
                        <input type="file" name="file" required class="form-control">
                        @error('file')<span class="text-danger">{{ $message }}</span>@enderror
                        <img src="{{ url('storage/uploads/'.$user->image) }}" height="100px" width="100px" class="mt-2">
                     </div>

                     <div class="form-group mb-3">
                        <label>City</label>
                        <input type="text" name="city" required class="form-control" value="{{ $user->city  }}" >
                        @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                     </div>

                    <div class="form-group mb-3">
                        <label>Country</label>
                        <select  id="country-dropdown" class="form-control" required name="countrty">
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $data)
                            <option value="{{$data->id}}" {{  $user->country_id == $data->id ? 'selected' : '' }}>
                                {{$data->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('country')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group mb-3">
                        <label>State</label>
                        <select id="state-dropdown" class="form-control" name="state">
                        </select>
                        @error('state')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#country-dropdown').on('change', function () {
                var idCountry = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{url('get-state')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('#state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(response.data, function (key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });

            });
        });

    </script>

</body>

</html>