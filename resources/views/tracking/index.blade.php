@extends('layouts.body')
@section('content')
  {{-- HOME --}}
  <div class="container">

    <div class="row">
      <div class="col-sm-12">
        <h2 style="padding-bottom: 10px;">Detail Package</h2>

        {{-- Transaction Detail --}}
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col" colspan="2">
                <h4>Transaction</h4>
              </th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td><b>Receipt Number</b></td>
              <td style="font-weight: 600;">{{$data['transaction']->receipt_number}}</td>
            </tr>
            <tr>
              <td><b>Price/kg</b></td>
              <td style="font-weight: 600;">{{$data['transaction']->price_per_kg}}</td>
            </tr>
            <tr>
              <td><b>Total Price</b></td>
              <td style="font-weight: 600;">{{$data['transaction']->total_price}}</td>
            </tr>
            <tr>
              <td><b>Status</b></td>
              <td style="font-weight: 600;">{{$data['transaction']->status}}</td>
            </tr>
          </tbody>
        </table>

        <br>

        {{-- Detail Package --}}
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col" colspan="2">
                <h4>Package</h4>
              </th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td><b>Package Name</b></td>
              <td style="font-weight: 600;">{{$data['transaction']->package->package_name}}</td>
            </tr>
            <tr>
              <td><b>Weight</b></td>
              <td style="font-weight: 600;">{{$data['transaction']->package->weight}}</td>
            </tr>
            <tr>
              <td><b>Dimension</b></td>
              <td style="font-weight: 600;">{{$data['transaction']->package->dimension}}</td>
            </tr>
            <tr>
              <td><b>Category</b></td>
              <td style="font-weight: 600;">{{$data['transaction']->package->category->category_name}}</td>
            </tr>
          </tbody>
        </table>

        <br>
        
        <div class="row" style="padding-top:24px;">
          <div class="col-sm-12">
            <h2 style="padding-bottom: 10px;">Detail Shipping</h2>
          </div>
          {{-- Origin --}}
          <div class="col-sm-6">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" colspan="2">
                    <h4>Origin</h4>
                  </th>
                </tr>
              </thead>
    
              <tbody>
                <tr>
                  <td><b>Name</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->origin->users->name}}</td>
                </tr>
                <tr>
                  <td><b>Email</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->origin->users->email}}</td>
                </tr>
                <tr>
                  <td><b>Phone Number</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->origin->users->phone}}</td>
                </tr>
                <tr>
                  <td><b>Province</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->origin->province_name}}</td>
                </tr>
                <tr>
                  <td><b>Region</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->origin->region_name}}</td>
                </tr>
                <tr>
                  <td><b>Postal Code</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->origin->postal_code}}</td>
                </tr>
                <tr>
                  <td><b>Address</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->origin->detail_address}}</td>
                </tr>
              </tbody>
            </table>
          </div>

          {{-- Destination --}}
          <div class="col-sm-6">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col" colspan="2">
                    <h4>Destination</h4>
                  </th>
                </tr>
              </thead>
    
              <tbody>
                <tr>
                  <td><b>Name</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->recepient_name}}</td>
                </tr>
                <tr>
                  <td><b>Phone Number</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->recepient_phone}}</td>
                </tr>
                <tr>
                  <td><b>Province</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->destination->province_name}}</td>
                </tr>
                <tr>
                  <td><b>Region</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->destination->region_name}}</td>
                </tr>
                <tr>
                  <td><b>Postal Code</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->destination->postal_code}}</td>
                </tr>
                <tr>
                  <td><b>Address</b></td>
                  <td style="font-weight: 600;">{{$data['transaction']->package->destination->detail_address}}</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>

      </div>
    </div>

    <br>
    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <div class="row">
          <div class="col-sm-10"><h2 style="padding-bottom: 10px;">History</h2></div>
          <div class="col-sm-2">
            <a href="/tracking/create/{{$data['transaction']->receipt_number}}" class="btn btn-primary">Update Status</a>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Status</th>
                <th scope="col">Transport</th>
                <th scope="col">License Number</th>
                <th scope="col">Update Time</th>
              </tr>
            </thead>
            <tbody>
              @if (empty($data['tracking']))
              <tr>
                <td colspan="5" style="font-weight: 600; text-align: center;">Data empty</td>
              </tr>
              @endif
              @foreach ($data['tracking'] as $item)
                  <tr>
                    <td style="font-weight: 600;">{{$item->tracking_status}}</td>
                    @if (empty($item->transport))
                      <td style="font-weight: 600;"> - </td>
                      <td style="font-weight: 600;"> - </td>
                    @else
                      <td style="font-weight: 600;">{{$item->transport->name}}</td>
                      <td style="font-weight: 600;">{{$item->transport->license_number}}</td>
                    @endif
                    <td style="font-weight: 600;">{{$item->created_at}}</td>
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