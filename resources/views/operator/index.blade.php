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
            <a href="/operator/create/" class="btn btn-primary">Add Operator</a>
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
                <th scope="col">Unique ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
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
                  <td style="font-weight: 600;">{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->email}}</td>
                  <td>{{$item->phone}}</td>
                  @if (auth()->user()->role == 'admin')
                  <td>
                    <div class="row" style="width: 100%">
                      <div class="col-sm-4">
                        <a href="/operator/edit/{{$item->id}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                      </div>
                      <div class="col-sm-4">
                        <form action="/operator/delete/{{$item->id}}" method="post">
                          @csrf
                          @method('PUT')
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
