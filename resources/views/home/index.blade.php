<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PackBoss - Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  {{-- NAV --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand">PackBoss</span>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Package</a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        @endif
      </ul>
    </div>
  </nav>
  {{-- END-NAV --}}
  
  <br>

  {{-- HOME --}}
  <div class="container">

    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <h2 style="padding-bottom: 10px;">Dashboard</h2>

        @if (Auth::user()->role == 'operator')
        <div class="row">
          <div class="col-sm-6">
            <div class="card text-center">
              <div class="card-header bg-primary text-white" style="font-weight: 600; font-size: 18px;">
                Package on Waiting
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">80</h5>
                <a href="#" class="btn btn-primary">Check Package</a>
              </div>
            </div>
          </div>
    
          <div class="col-sm-6">
            <div class="card text-center">
              <div class="card-header bg-warning" style="font-weight: 600; font-size: 18px;">
                Transports
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">80</h5>
                <a href="#" class="btn bg-warning text-dark">Check Transport</a>
              </div>
            </div>
          </div>
        </div>
        @endif

        @if (Auth::user()->role == 'admin')
        <div class="row">
          <div class="col-sm-3">
            <div class="card text-center">
              <div class="card-header bg-primary text-white" style="font-weight: 600; font-size: 18px;">
                Package on Waiting
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">80</h5>
                <a href="#" class="btn btn-primary">Check Package</a>
              </div>
            </div>
          </div>
    
          <div class="col-sm-3">
            <div class="card text-center">
              <div class="card-header bg-warning" style="font-weight: 600; font-size: 18px;">
                Transports
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">80</h5>
                <a href="#" class="btn bg-warning text-dark">Check Transport</a>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="card text-center">
              <div class="card-header bg-primary text-white" style="font-weight: 600; font-size: 18px;">
                Package on Waiting
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">80</h5>
                <a href="#" class="btn btn-primary">Check Package</a>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="card text-center">
              <div class="card-header bg-warning" style="font-weight: 600; font-size: 18px;">
                Transports
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">80</h5>
                <a href="#" class="btn bg-warning text-dark">Check Transport</a>
              </div>
            </div>
          </div>
        </div>
        @endif

      </div>
    </div>

    <br>
    
    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <h2 style="padding-bottom: 10px;">History</h2>
        
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Package Receipt</th>
              <th scope="col">Pick-Up Location</th>
              <th scope="col">Pick-Up Time</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Mark</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>Mark</td>
              <td>the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    

  </div>
  {{-- END-HOME --}}

</body>
</html>