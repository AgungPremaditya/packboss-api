@extends('layouts.body')
@section('content')
  {{-- HOME --}}
  <div class="container">

    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <h2 style="padding-bottom: 10px;">Tracking Update</h2>

        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header text-center bg-primary text-white" style="font-weight: 600; font-size: 18px;">
                Update Status Tracking
              </div>
              <div class="card-body bg-light">
                <form action="/tracking/store" method="post">
                  @csrf
        
                  <label for="receipt-number" class="form-label" style="font-weight: 600;">Package Receipt Number</label>
                  <div class="input-group mb-3">
                    <input type="text" name="receipt_number" class="form-control" id="receipt-number" readonly value="{{$data['transaction']->receipt_number}}">
                  </div>

                  <label for="transport" class="form-label" style="font-weight: 600;">Status</label>
                  <div class="mb-3">
                    <select name="status" class="transport-select bg-white" data-style="btn-primary" data-width="100%" title="Update status...">
                      <option value="waiting-for-pickup">waiting-for-pickup</option>
                      <option value="on-pickup">on-pickup</option>
                      <option value="on-office-storage">on-office-storage</option>
                      <option value="on-sorting">on-sorting</option>
                      <option value="on-delivery-courier">on-delivery-courier</option>
                      <option value="delivered">delivered</option>
                      <option value="canceled">canceled</option>
                    </select>
                  </div>

                  <label for="transport" class="form-label" style="font-weight: 600;">Transport</label>
                  <div class="mb-3">
                    <select name="id_transport" class="transport-select bg-white" data-live-search="true" data-style="btn-primary" data-width="100%" title="Choose the transport...">
                      <option value=""> - </option>
                      @foreach ($data['transport'] as $item)
                        <option value="{{$item->id}}">{{$item->name }} - {{ $item->transport_code}}</option>
                      @endforeach
                    </select>
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
  {{-- END-HOME --}}
  
@endsection

@section('script')

<script>
  $(function () {
    $('.transport-select').selectpicker();
  });
</script>

@endsection