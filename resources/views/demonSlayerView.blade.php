<html>

<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 <title>Account</title>
 </head>

 <div>
    <?php echo("<h3 class='fw-semibold m-2'>Welcome, ".$demonSlayer->name."!<h3>"); ?>
 </div>


@if(count($resultSubmitted)==0)
<div class="border border-danger m-1">
<form method="POST" class="form-group m-1">

    @csrf
    <label for="demonsKilled" class="form-label">DemonsKilled: </label>
    <input type="number" name="demonsKilled" id="demonsKilled" class="form-control">

    <label for="demonsKilledAlone" class="form-label">DemonsKilledAlone: </label>
    <input type="number" name="demonsKilledAlone" id="demonsKilledAlone" class="form-control">

    <button type="submit" class="btn btn-danger mt-1">Submit</button>
</form>
</div>
@endif




</html>