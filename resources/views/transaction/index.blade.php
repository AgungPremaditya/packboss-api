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
        <li class="nav-item">
          <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Transaction</a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link" href="/operator">Operator</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/transaction">Transaction</a>
        </li>
        @endif
      </ul>
    </div>
  </nav>
  {{-- END-NAV --}}
  
  <br>

  {{-- HOME --}}
  <div class="container">
    <br>
    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <h2 style="padding-bottom: 10px;">Transaction</h2>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Package Receipt</th>
                <th scope="col">Pick-Up Location</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($data->isEmpty())
              <tr>
                <td colspan="5" style="font-weight: 600; text-align: center;">Data empty</td>
              </tr>
              @endif

              @foreach ($data as $item)
                  <tr>
                    <td style="font-weight: 600;">{{$item->receipt_number}}</td>
                    <td>{{$item->package->origin->detail_address}}</td>
                    <td style="font-weight: 600;">{{$item->status}}</td>
                    <td>
                      <a href="/tracking/{{$item->receipt_number}}" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  {{-- END-HOME --}}

</body>
</html>