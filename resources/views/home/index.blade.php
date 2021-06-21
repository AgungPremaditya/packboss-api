@extends('layouts.body')
@section('content')
  {{-- HOME --}}
  <div class="container">

    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <h2 style="padding-bottom: 10px;">Dashboard</h2>

        @if (Auth::user()->role == 'operator')
        <div class="row">
          <div class="col-sm-4">
            <div class="card text-center">
              <div class="card-header bg-primary text-white" style="font-weight: 600; font-size: 18px;">
                Package on Waiting
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">{{$data['waiting-list']}}</h5>
                <a href="/on-waiting" class="btn btn-primary">Check Package</a>
              </div>
            </div>
          </div>
    
          <div class="col-sm-4">
            <div class="card text-center">
              <div class="card-header bg-warning" style="font-weight: 600; font-size: 18px;">
                Transports
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">{{$data['transport']}}</h5>
                <a href="#" class="btn bg-warning text-dark">Check Transport</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card text-center">
              <div class="card-header bg-info text-white" style="font-weight: 600; font-size: 18px;">
                Transaction
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">{{$data['transaction']}}</h5>
                <a href="#" class="btn bg-info text-white">Check Transaction</a>
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
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">{{$data['waiting-list']}}</h5>
                <a href="/on-waiting" class="btn btn-primary">Check Package</a>
              </div>
            </div>
          </div>
    
          <div class="col-sm-3">
            <div class="card text-center">
              <div class="card-header bg-warning" style="font-weight: 600; font-size: 18px;">
                Transports
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">{{$data['transport']}}</h5>
                <a href="#" class="btn bg-warning text-dark">Check Transport</a>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="card text-center">
              <div class="card-header bg-secondary text-white" style="font-weight: 600; font-size: 18px;">
                Operator
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">{{$data['operator']}}</h5>
                <a href="#" class="btn bg-secondary text-white">Check Operator</a>
              </div>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="card text-center">
              <div class="card-header bg-info text-white" style="font-weight: 600; font-size: 18px;">
                Transaction
              </div>
              <div class="card-body bg-light">
                <h5 class="card-title" style="font-weight: 600; font-size: 42px; margin: 20px;">{{$data['transaction']}}</h5>
                <a href="#" class="btn bg-info text-white">Check Transaction</a>
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

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Package Receipt</th>
                <th scope="col">Pick-Up Location</th>
                <th scope="col">Pick-Up Time</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              @if ($data['pickup']->isEmpty())
              <tr>
                <td colspan="5" style="font-weight: 600; text-align: center;">Data empty</td>
              </tr>
              @endif
              @foreach ($data['pickup'] as $item)
                  <tr>
                    <td style="font-weight: 600;">{{$item->transaction->receipt_number}}</td>
                    <td>{{$item->transaction->package->origin->detail_address}}</td>
                    <td>{{$item->pickedup_at}}</td>
                    <td style="font-weight: 600;">{{$item->transaction->status}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    

  </div>
  {{-- END-HOME --}}
  
@endsection