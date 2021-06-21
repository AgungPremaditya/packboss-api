@extends('layouts.body')
@section('content')
  {{-- HOME --}}
  <div class="container">
    <div class="row">
      <div class="col-sm-12" style="padding: 18px;">
        <h2 style="padding-bottom: 10px;">Operator</h2>

        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header text-center bg-primary text-white" style="font-weight: 600; font-size: 18px;">
                Add Operator
              </div>
              <div class="card-body bg-light">
      
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                  <ul>
                    @foreach ($errors->all(':message') as $item)
                      <li>{{$item}}</li>  
                    @endforeach
                  </ul>    
                  {{-- {{ implode('\n', $errors->all(':message')) }} --}}
                </div>
                @endif
                <form action="/operator/update/{{$data->id}}" method="post">
                  @csrf
                  @method('PUT')
                  
                  <label for="name" class="form-label" style="font-weight: 600;">Name</label>
                  <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" id="name" autocomplete="off" value="{{$data->name}}">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="phone" class="form-label" style="font-weight: 600;">Phone</label>
                      <div class="input-group mb-3">
                        <input type="text" name="phone" class="form-control" id="phone" value="{{$data->phone}}">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label for="email" class="form-label" style="font-weight: 600;">Email</label>
                      <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" id="email" value="{{$data->email}}" autocomplete="chrome-off">
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