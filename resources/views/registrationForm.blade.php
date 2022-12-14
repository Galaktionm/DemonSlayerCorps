<html>

    <form method="POST">
		@csrf
        <label for="name">Enter your username: </label>
		<input type="text" name="username" id="username">
		<label for="name">Enter your name: </label>
		<input type="text" name="name" id="name">
        <label for="password">Enter your password: </label>
		<input type="password" name="password" id="password">
	
		<input type="submit" value="Submit">
	
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