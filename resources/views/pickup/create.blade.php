<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PackBoss - Home</title>
  
  <!-- Latest compiled and minified CSS Bootstrap 4-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Latest compiled and minified CSS Select Search-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  <!-- Latest compiled and minified CSS DatePicker-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <!-- Latest compiled and minified JavaScript Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Latest compiled and minified JavaScript Select Search-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

  <!-- Latest compiled and minified JavaScript DatePicker-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
</head>
</head>
<body>
  {{-- NAV --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <span class="navbar-brand">PackBoss</span>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/transaction">Transaction</a>
        </li>
        @if (Auth::user()->role == 'admin')
        <li class="nav-item">
          <a class="nav-link" href="/operator">Operator</a>
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
        <h2 style="padding-bottom: 10px;">Pickup</h2>

        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header text-center bg-primary text-white" style="font-weight: 600; font-size: 18px;">
                Add Pick-up
              </div>
              <div class="card-body bg-light">
                  <form action="/pickup/store" method="post">
                    @csrf
                    
                    <label for="receipt-number" class="form-label" style="font-weight: 600;">Package Receipt Number</label>
                    <div class="input-group mb-3">
                      <input type="text" name="receipt_number" class="form-control" id="receipt-number" readonly value="{{$data['transaction']->receipt_number}}">
                    </div>

                    <label for="transport" class="form-label" style="font-weight: 600;">Transport</label>
                    <div class="mb-3">
                      <select name="id_transport" class="transport-select bg-white" data-live-search="true" data-style="btn-primary" data-width="100%" title="Choose the transport...">
                        @foreach ($data['transport'] as $item)
                          <option value="{{$item->id}}">{{$item->name }} - {{ $item->transport_code}}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <label for="time" class="form-label" style="font-weight: 600;">Time PickUp</label>
                        <input name="pickedup_at_time" type="time" class="form-control" id="time">
                      </div>
                      
                      <div class="col-sm-6">
                        <label for="date" class="form-label" style="font-weight: 600;">Date PickUp</label>
                        <input name="pickedup_at_date" type="date" class="form-control" id="date">
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>

        </div>
      </div>
    </div>


  </div>
  {{-- END-HOME --}}

</body>

<script>
  $(function () {
    $('.transport-select').selectpicker();
  });
</script>

</html>