@extends('include.app')
@section('title', 'VPS Submit')
@section('content')
    <div class="container py5">
        <h6 style="font-size: 8pt" class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a> > 
            <a href="{{ route('vps') }}" class="text-decoration-none">VPS</a> > 
            Submit
        </h6>
        <div class="ht-tm-cat">
            <h5 class="ht-tm-cat-title">Submit New VPS</h5>
            <div class="ht-tm-codeblock">
                <div class="row">
                    <div class="col-xl-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="ht-tm-codeblock ht-tm-btn-replaceable ht-tm-element ht-tm-element-inner">
                            <form method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label>IP <font color="red">*</font></label>
                                    <input type="text" class="form-control" name="ip" placeholder="103.129.221.24" required>
                                </div>
                                <div class="form-group">
                                    <label>PORT <font color="red">*</font></label>
                                    <input type="text" class="form-control" name="port" placeholder="22" required>
                                </div>
                                <div class="form-group">
                                    <label>User <font color="red">*</font></label>
                                    <input type="text" class="form-control" name="user" placeholder="abay" required>
                                </div>
                                <div class="form-group">
                                    <label>Password <font color="red">*</font></label>
                                    <input type="text" class="form-control" name="password" placeholder="bayabayy" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-outline-primary btn-sm">SUBMIT</button>
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