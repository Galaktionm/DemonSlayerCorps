<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 <title>Account</title>
</head>

 <div>
    <?php echo("<h3 class='fw-semibold m-2'>Welcome, ".$hashira->name."!<h3>"); ?>
 </div>

<div class="container-fluid">
<div class="row">
    <div class="col-6 border border-primary">
        <div class="m-1">
        <p class='fw-semibold m-2'>Here are your assigned students: </p>
		<ul class="list-group">
		@for ($i=0; $i<count($demonSlayers); $i++)
		   <?php echo("<li class='list-group-item text-primary m-1'>".$demonSlayers[$i]->name."</li>") ?>
		@endfor		
		</ul>
	</div>
    </div>

<div class="col-6 border border-danger">
    <div class="m-2 border border-primary">
    <form method="POST" class="form-group m-2">
        @csrf
        <label for="message" class="form-label">Enter a message you'd like to send to all of your stutends: </label>
        <input type="text" name="message" id="message" class="form-control">

        <button type="submit" class="btn btn-danger mt-2">Send</button>
    </form>
    </div>

    <div class="border border-primary m-2">
        <p>We appreciate all the work you do for the humanity</p>
    </div>
</div>

</div>
</div>
</div>
</html>