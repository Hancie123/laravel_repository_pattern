<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>Stacked form</h2>
        <form action="{{ url('/') }}" method="post">
            @csrf
            <div class="mb-3 mt-3">
                <label for="email">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pwd">Email:</label>
                <input type="text" class="form-control" id="pwd" placeholder="Enter email" name="email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contact as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td><a href="{{url('/delete')}}/{{$data->id}}" class="btn btn-primary">Trash</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if (Session::has('success'))
        <div class="alert alert-danger">
            {{Session::get('success')}}
        </div>

        @endif








</body>

</html>
