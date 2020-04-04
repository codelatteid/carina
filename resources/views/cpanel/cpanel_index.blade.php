@extends('include.app')
@section('title', 'cPanel List')
@section('content')
    <div class="container py5">
        <h6 style="font-size: 8pt" class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a> > 
            cPanel
        </h6>
        <div class="ht-tm-cat">
            <form>
                <div class="mb-3">
                    <input type="text" class="form-control col-md-6 mb-1" placeholder="{{ (isset($_GET['keyword']) !== false) ? $_GET['keyword'] : 'Domain, Username, Server Info' }}" name="keyword">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary btn-sm" type="button">Search</button>
                    </div>
                </div>
            </form>
            <h5 class="ht-tm-cat-title mb-3">
                cPanels List <a href="{{ route('cpanel') }}/new" class="btn btn-outline-primary btn-sm mb-2 pull-right" title="Submit New cPanel"><span class="fa fa fa-plus-square fa-fw"></span> Submit New</a>
            </h5>

            @if ($message = Session::get('alert'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{ $message }}
            </div>
            @endif
            <div class="ht-tm-codeblock" style="max-width: 100%; overflow: scroll;">
                <table class="table table-hover table-striped ht-tm-element border">
                    <thead class="thead-dark">
                        <tr>
                        <th width="30">#</th>
                        <th width="200">Date</th>
                        <th width="500">Domain</th>
                        <th width="200">Username</th>
                        <th width="50" class="text-center">Status</th>
                        <th class="text-center" width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        @php
                        $skipped = ($data->currentPage() * $data->perPage()) - $data->perPage();
                        @endphp
                        <tr>
                            <th scope="row">{{ $loop->iteration + $skipped }}</th>
                            <td>{{ $d->created_at }}</td>
                            <td><a href="{{ $d->port == 2083 ? 'https' : 'http' }}://{{ $d->domain }}:{{ $d->port }}" target="_blank">{{ $d->domain }}:{{ $d->port }} <span class="fa fa-external-link"></span></a></td>
                            <td>{{ $d->username }}</td>
                            <td class="text-center">
                                <i class="{{ ($d->status == 'active') ? "fa fa-check-circle-o text-success" : "fa fa-close text-danger"  }}"></i>
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('cpanel') }}/delete">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ Crypt::encryptString($d->id) }}">
                                    <a href="{{ route('cpanel') }}/detail/{{ Crypt::encryptString($d->id) }}" class="btn btn-outline-primary btn-sm" title="Detail cPanel"><span class="fa fa-eye fa-fw"></span></a>
                                    <button class="btn btn-outline-primary btn-sm" title="Delete cPanel" onclick="return confirm('Are you sure?')"><span class="fa fa-trash fa-fw"></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $data->links() !!}
            </div>
        </div>
    </div>
@endsection