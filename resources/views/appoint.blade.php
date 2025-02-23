<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <form>
        <h5><i class = "bi bi-journal-richtext"></i>Make a Appointment</h5>
        <form method = "post" action = "{{'store'}}">
            @csrf
            @method('post')

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" >
        </div>
        <div class="mb-3">
          <label for="age" class="form-label">Age</label>
          <input type="integert" class="form-control" id="age">
        </div>
        <div class="mb-3 ">
            <label for="datetime" class="form-label">Date and Time</label>
            <input type="dateTime" class="form-control" id="datetime" >
        </div>
        <div class="mb-3 ">
            <label for="service" class="form-label">Services</label>
            <input type="text" class="form-control" id="service" >
        </div>
        <div class="mb-3 ">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>

      </form>

</body>
</html>

