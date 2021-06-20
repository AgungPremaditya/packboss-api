@extends('layouts.body')
@section('content')
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

@endsection
