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
          @if (auth()->user()->role == 'admin')
          <div class="col-sm-2">
            <a href="/transport/create/" class="btn btn-primary">Add Transport</a>
          </div>
          @endif
        </div>
      
        @if($errors->any())
          <div class="alert alert-danger" role="alert">
            {{ implode('', $errors->all(':message')) }}
          </div>
        @endif

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Transport Code</th>
                <th scope="col">Name</th>
                <th scope="col">License Code</th>
                <th scope="col">Type</th>
                @if (auth()->user()->role == 'admin')
                <th scope="col">Action</th>
                @endif
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
                    <div class="row" style="width: 100%">
                      <div class="col-sm-3">
                        <a href="/transport/edit/{{$item->id}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                      </div>
                      <div class="col-sm-3">
                        <form action="/transport/delete/{{$item->id}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                          </button>
                        </form>
                      </div>
                    </div>
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
