@extends('layouts.body')
@section('content')
  {{-- HOME --}}
  <div class="container">
    <br>
    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <div class="row">
          <div class="col-sm-10">
            <h2 style="padding-bottom: 10px;">Transport</h2>
          </div>
          <div class="col-sm-2">
            <a href="/transport/create/" class="btn btn-primary">Add Transport</a>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Transport Code</th>
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
                  <td style="font-weight: 600;">{{$item->transport_code}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->license_number}}</td>
                  <td style="text-transform: capitalize;">
                    {{($item->transport_type == 'pick_up') ? str_replace('_', '-',$item->transport_type) : str_replace('_', ' ',$item->transport_type)}}
                  </td>
                  @if (auth()->user()->role == 'admin')
                  <td>
                    <a href="/tracking/{{$item->receipt_number}}" class="btn btn-primary">Detail</a>
                  </td>
                  @endif
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
