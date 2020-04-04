@extends('include.app')
@section('title', 'cPanel Details')
@section('content')
    <div class="container py5">
        <h6 style="font-size: 8pt" class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a> > 
            <a href="{{ route('cpanel') }}" class="text-decoration-none">cPanel</a> > 
            cPanel Details
        </h6>
        <div class="ht-tm-cat">
            <h5 class="ht-tm-cat-title">cPanel {{ strtoupper($data->domain) }}</h5>
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
                                    <label>Domain</label>
                                    <input type="text" class="form-control" value="{{ $data->domain }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Port</label>
                                    <input type="text" class="form-control" value="{{ $data->port }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="{{ $data->username }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" value="{{ $data->password }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control" value="{{ strtoupper($data->status) }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Recheck</label><br/>
                                    <input type="submit" class="btn btn-primary btn-sm" value="Recheck cPanel">
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