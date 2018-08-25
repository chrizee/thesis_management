@extends("layouts.app2")

@section("content")
    <div class="page-content">
        <div class="row mbl">
            <div class="col-lg-12">
                <div class="page-content">
                    <div class="col-lg-12">
                        <a href="{{ route("thesis.create") }}" class="btn btn-success btn-sm" > <i class="fa fa-plus"></i> New Project</a>
                        <div class="panel">
                            <div class="panel-body">
                                @include("thesis.template")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection