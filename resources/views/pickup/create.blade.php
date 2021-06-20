@extends('layouts.body')
@section('content')
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
  {{-- END-HOME --}}
  
@endsection

@section('script')

<script>
  $(function () {
    $('.transport-select').selectpicker();
  });
</script>

@endsection