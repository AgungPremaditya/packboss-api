@extends('layouts.body')
@section('content')
  {{-- HOME --}}
  <div class="container">
    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <h2 style="padding-bottom: 10px;">Transport</h2>

        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header text-center bg-primary text-white" style="font-weight: 600; font-size: 18px;">
                Add Transport
              </div>
              <div class="card-body bg-light">
                <form action="/transport/update/{{$data->id}}" method="POST">
                  @csrf
                  @method('PUT')

                  <label for="receipt-number" class="form-label" style="font-weight: 600;">Name</label>
                  <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" id="receipt-number" value="{{$data->name}}">
                  </div>

                  <label for="transport" class="form-label" style="font-weight: 600;">Type</label>
                  <div class="mb-3">
                    <select id="type" name="type" class="transport-select bg-white" data-live-search="true" data-style="btn-primary" data-width="100%" title="Choose the transport type...">
                      <option {{($data->transport_type == 'truck_box') ? 'selected' : '' }} value="truck_box">Truck Box</option>
                      <option {{($data->transport_type == 'truck') ? 'selected' : '' }} value="truck">Truck</option>
                      <option {{($data->transport_type == 'pick_up') ? 'selected' : '' }} value="pick_up">Pick-up</option>
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="time" class="form-label" style="font-weight: 600;">License Number</label>
                      <input id="license" name="license_number" type="text" class="form-control" id="time" value="{{$data->license_number}}">
                    </div>

                    <div class="col-sm-6">
                      <label for="date" class="form-label" style="font-weight: 600;">Transport Code</label>
                      <div class="row">
                        <div class="col-sm-8">
                          <input id="code" type="text" name="transport_code" class="form-control" readonly value="{{$data->transport_code}}">
                        </div>
                        <div class="col-sm-2">
                          <button type="button" class="btn btn-primary" onclick="return generateCode()">Generate Code</button>
                        </div>
                      </div>
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

  function generateCode(){
    var type = document.getElementById('type').value;
    
    var code_1;
    switch (type) {
      case 'truck_box':
        code_1 = 'TRBX'
        break;
      case 'truck':
        code_1 = 'TR'
        break;
      case 'pick_up':
        code_1 = 'PU'
        break;
    
      default:
        break;
    }

    var code_2 = document.getElementById('license').value;

    document.getElementById('code').value = code_1+'-'+code_2.split(' ').join('');
  }

</script>

@endsection