<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<title>Login</title>
</head>

    <form method="POST" class="form-group container border border-danger mt-2" >
		@csrf
		<label for="text">Enter your name: </label>
		<input type="text" name="username" id="username" class="form-control">

        <label for="password">Enter your password: </label>
		<input type="password" name="password" id="password" class="form-control">
	
		<button type="submit" class="btn btn-danger mt-2">Submit</button>
	
	</form>

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


</html>