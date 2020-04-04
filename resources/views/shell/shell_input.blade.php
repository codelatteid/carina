@extends('include.app')
@section('title', 'Shell Submit')
@section('content')
    <div class="container py5">
        <h6 style="font-size: 8pt" class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a> > 
            <a href="{{ route('shell') }}" class="text-decoration-none">Shells</a> > 
            Submit
        </h6>
        <div class="ht-tm-cat">
            <h5 class="ht-tm-cat-title">Submit New Shell</h5>
            <div class="ht-tm-codeblock">
                <div class="row">
                    <div class="col-xl-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="ht-tm-codeblock ht-tm-btn-replaceable ht-tm-element ht-tm-element-inner">
                            <form method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label>URL <font color="red">*</font></label>
                                    <input type="text" class="form-control" name="url" placeholder="https://abaykan.com/images/upload/shell.php" required>
                                    <small class="form-text text-muted">For use this fiture, you should use <a href="{{ route('shell') }}/source" target="_blank">custom shell script</a>.</small>
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