<!-- index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Blue Services Test App</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="container">
    <br />
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    <a href="{{action('ProductController@index')}}" class="btn btn-success">Main list</a>
    <a href="{{action('ProductController@having', ['input' => 1])}}" class="btn btn-warning">Available</a>
    <a href="{{action('ProductController@having', ['input' => 0])}}" class="btn btn-warning">Unavailable</a>
    <a href="{{action('ProductController@having', ['input' => 6])}}" class="btn btn-danger">Having more than 5</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Amount</th>
            <th colspan="1">Action</th>
            <td><a href="{{action('ProductController@create')}}" class="btn btn-success">New</a></td>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->amount}}</td>

                <td><a href="{{action('ProductController@edit', $product->id)}}" class="btn btn-warning">Edit</a></td>
                <td>
                    <form action="{{action('ProductController@destroy', $product->id)}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>