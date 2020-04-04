@extends('include.app')
@section('title', 'Custom Shell')
@section('content')
    <div class="container py5">
        <h6 style="font-size: 8pt" class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a> > 
            <a href="{{ route('shell') }}" class="text-decoration-none">Shells</a> > 
            Custom Shell
        </h6>
        <div class="ht-tm-cat">
            <h5 class="ht-tm-cat-title">Custom Shell</h5>
            <div class="ht-tm-codeblock">
                <div class="row">
                    <div class="col-xl-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="ht-tm-codeblock ht-tm-btn-replaceable ht-tm-element ht-tm-element-inner">
                            <div class="form-group">
                                <label>Custom Shell</label>
                                <textarea class="form-control" rows="20" readonly>{{file_get_contents('https://pastebin.com/raw/Zgqh6tB0')}}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm form-control"><span class="fa fa-copy fa-fw"></span> Copy</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
    $("button").click(function(){
        $("textarea").select();
        document.execCommand('copy');
        alert('Copied!');
    });
</script>
@endsection