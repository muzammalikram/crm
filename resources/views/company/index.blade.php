@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <hr>
                <a href="{{route('company.create')}}" class="btn btn-info" >ADD companies</a>
                <hr>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">

                        @if(count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="alert alert-info">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="th-sm">Id</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Email</th>
                            <th class="th-sm">logo</th>
                            <th class="th-sm">website</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $a = 1;
                        @endphp
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $a++ }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td><img src="{{ asset('/storage/'.$company->logo) }}" alt="" width="70px;" height="70px;"></td>
                                <td>{{ $company->website }}</td>
                                <td><a href="{{ route('company.index') }}/{{$company->id}}/edit" class="btn btn-primary">edit</a></td>
                                    <td>
                                        <form action="{{ route('company.index') }}/{{$company->id}}" method="post">
                                            @method('DELETE')
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                                            <button type="submit" class="btn btn-danger">Delted</button>
                                        </form>
                                    </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="th-sm">Id</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Email</th>
                            <th class="th-sm">logo</th>
                            <th class="th-sm">website</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                        </tfoot>
                    </table>

                    {{ $companies->links() }}
                </div>
            </div>


        </div>
@endsection
