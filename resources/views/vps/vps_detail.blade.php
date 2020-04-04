@extends('include.app')
@section('title', 'VPS Details')
@section('content')
    <div class="container py5">
        <h6 style="font-size: 8pt" class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a> > 
            <a href="{{ route('vps') }}" class="text-decoration-none">VPS</a> > 
            VPS Details
        </h6>
        <div class="ht-tm-cat">
            <h5 class="ht-tm-cat-title">VPS {{ strtoupper($data->ip) }}</h5>
            @if ($message = Session::get('alert'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{ $message }}
            </div>
            @endif
            <div class="ht-tm-codeblock">
                <div class="row">
                    <div class="col-xl-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="ht-tm-codeblock ht-tm-btn-replaceable ht-tm-element ht-tm-element-inner">
                            <form method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="hidden" class="form-control" value="{{ Crypt::encryptString($data->id) }}">
                                    <input type="text" class="form-control" value="{{ $data->created_at }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>IP</label>
                                    <input type="text" class="form-control" value="{{ $data->ip }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Port</label>
                                    <input type="text" class="form-control" value="{{ $data->port }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>User</label>
                                    <input type="text" class="form-control" value="{{ $data->user }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" value="{{ $data->password }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Server Information</label>
                                    <input type="text" class="form-control" value="{{ $data->server_info }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control" value="{{ strtoupper($data->status) }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Recheck</label><br/>
                                    <input type="submit" class="btn btn-primary btn-sm" value="Recheck VPS">
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection