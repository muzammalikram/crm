@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>Create Company</center>
               @include('partials.errors')
            @if(request()->path() == "company/create")
                <form method="post" action="{{ route('company.store') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="form-group">
                        <label for="post">name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="post">E-mail</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}"  placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="post">website</label>
                        <input type="text" class="form-control" name="website" value="{{old('website')}}"  placeholder="Enter website name">
                    </div>


                    <div class="form-group">
                        <label for="img">Upload logo</label>
                        <input type="file" class="form-control-file" name="logo" id="img">
                    </div>
                    <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                </form>
                @else
                    <form method="post" action="{{ route('company.update' , $company->id) }}" enctype="multipart/form-data">
                      @method('PUT')
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label for="post">name</label>
                            <input type="text" class="form-control" name="name" value="{{$company->name}}"  placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="post">E-mail</label>
                            <input type="email" class="form-control" name="email" value="{{$company->email}}"  placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="post">website</label>
                            <input type="text" class="form-control" name="website" value="{{$company->website}}"  placeholder="Enter website name">
                        </div>


                        <div class="form-group">
                            <label for="img">Upload logo</label>
                            <img src="{{ asset('storage/'.$company->logo) }}" width="100px;" height="100px;" alt="">
                            <input type="file" class="form-control-file" name="logo" id="img">
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
