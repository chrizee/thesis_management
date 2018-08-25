@extends("layouts.app2")

@section("content")
    <div class="page-content">
        <div id="tab-general">
            <div class="row mbl">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row mtl">
                                <div class="@if($errors->any()) hidden @endif col-md-6 view">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 style="text-transform: capitalize;">{{ $thesis->name }}</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                                    <p><strong>Author:</strong> <br>
                                                        <em><strong style="text-transform: capitalize;" class="label label-danger">{{ $thesis->authors }}</strong></em>
                                                    </p>
                                                </div>

                                                @empty(!$thesis->author_phone)
                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                                    <p><strong>Author's Phone:</strong> <br>
                                                        <em><strong style="text-transform: capitalize;" class="label label-primary">{{ $thesis->author_phone }}</strong></em>
                                                    </p>
                                                </div>
                                                @endempty

                                                @empty(!$thesis->author_email)
                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                                        <p><strong>Author's Email:</strong> <br>
                                                            <em><strong style="text-transform: capitalize;" class="label label-grey">{{ $thesis->author_email }}</strong></em>
                                                        </p>
                                                    </div>
                                                @endempty

                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                                    <p><strong>Supervised by:</strong> <br>
                                                        <em><strong style="text-transform: capitalize;" class="label label-pink">{{ $thesis->supervisor->title." ".$thesis->supervisor->name }}</strong></em>
                                                    </p>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                                    <p><strong>Type:</strong> <br>
                                                        <span class="label label-info">{{ $thesis->tag->name }}</span>
                                                    </p>
                                                </div>

                                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
                                                    <p><strong>Level:</strong> <br>
                                                        <span class="label label-warning">{{ $thesis->level->name }}</span>
                                                    </p>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-3">
                                                    <p><strong>Session:</strong> <br>
                                                        <span class="label label-success">{{ $thesis->session }}</span>
                                                    </p>
                                                </div>
                                            </div>

                                            <p style="margin-bottom: 2px;"><strong>Abstract:</strong> </p>
                                            <p class="well text text-justify">{{ $thesis->abstract }}</p>
                                            <div class="row">
                                                <div class="btn-group btn-group-sm btn-group-justified">
                                                    <a href="#" class="btn btn-warning edit">Edit <i class="fa fa-edit"></i> </a>
                                                    <a href="" class="btn btn-info view">View paper <i class="fa fa-search"></i> </a>
                                                    <a href="/storage/project/{{ str_replace("/", '-', $thesis->session)."/".$thesis->location }}" target="_blank" class="btn btn-success download" download="{{ $thesis->location }}">Download <i class="fa fa-download"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="hidden col-md-6 view-project">
                                    @if($format == "docx" || $format == "doc" )
                                        <iframe width="100%" height="600px" src="http://docs.google.com/gview?url={{ config("app.url") }}/storage/project/{{ str_replace("/", '-', $thesis->session)."/".$thesis->location }}&embedded=true"></iframe>
                                    @elseif($format == "pdf")
                                        <iframe width="100%" height="600px" name="myiframe" id="myiframe" src="/storage/project/{{ str_replace("/", '-', $thesis->session)."/".$thesis->location }}"></iframe>
                                    @else
                                        <p>Document format is not supported. Try downloading it instead.</p>
                                    @endif
                                    {{--<embed src="/storage/project/{{ str_replace("/", '-', $thesis->session)."/".$thesis->location }}" type="application/pdf" width="100%" height="600px" ></embed>--}}
                                </div>
                                <div class="@if(!$errors->any()) hidden @endif col-md-9 edit-project">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 style="text-transform: capitalize;">Edit {{ $thesis->name }} <button class="pull-right btn btn-warning back"><i class="fa fa-arrow-circle-left"></i> back</button> </h4>
                                        </div>
                                        <div class="panel-body">
                                            <form action="{{ route("thesis.update", $thesis->id) }}" class="form-horizontal" id="edit-form" method="post" enctype="multipart/form-data"><h3>Project Info</h3>
                                                {{ csrf_field() }}
                                                {{ method_field("PUT") }}

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Project name <span class="text-danger">*</span> </label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9"><input name="project_name" value="{{ $thesis->name }}" type="text" placeholder="Design and construction of ..." class="form-control" required/></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="abstract">Abstract <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9"><textarea rows="3" id="abstract" name="abstract" value="{{ $thesis->abstract }}" class="form-control" required>{{ $thesis->abstract }}</textarea></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="tag">Area of work <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-4">
                                                                <select class="form-control" id="tag" name="tag" required>
                                                                    <option value="">--select--</option>
                                                                    @foreach($tags as $tag)
                                                                        <option value="{{ $tag->id }}" @if($thesis->tag_id == $tag->id) selected="selected" @endif>{{ $tag->name }}</option>
                                                                    @endforeach
                                                                    <option value="new">others</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group hidden new_tag">
                                                    <label class="col-sm-3 control-label">Tag name <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9"><input name="tag_name" value="{{ old("tag_name") }}" type="text" placeholder="Research" class="form-control" /></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="scope">Scope of work <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-4">
                                                                <select class="form-control" id="scope" name="scope" required>
                                                                    <option value="">--select--</option>
                                                                    @foreach($levels as $level)
                                                                        <option value="{{ $level->id }}" @if($thesis->level_id == $level->id) selected="selected" @endif>{{ $level->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group"><label class="col-sm-3 control-label">Publish now</label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <div class="radio"><label class="radio-inline"><input type="radio" value="1" name="published" @if($thesis->published) checked="checked" @endif/>&nbsp;
                                                                        Yes</label><label class="radio-inline"><input type="radio" value="0" name="published" @if(!$thesis->published) checked="checked" @endif/>&nbsp;
                                                                        No</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="session">Year of Project <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9">
                                                                <input name="session1" style="display: inline; width: 40%;" value="{{ explode('/', $thesis->session)[0] }}" type="text"  id="session" class="form-control" required data-inputmask="'alias': 'yyyy'" data-mask /> <span style="font-size: 2em">/</span>
                                                                <input name="session2" style="display: inline; width: 40%;" value="{{ explode('/', $thesis->session)[1] }}" type="text"  id="session2" class="form-control" required data-inputmask="'alias': 'yyyy'" data-mask />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />

                                                <h3>Author details</h3>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="author_name">Name <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9"><input name="authors" value="{{ $thesis->authors }}" type="text" placeholder="name" id="author_name" class="form-control" required /></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="email">Email</label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9"><input name="email" value="{{ $thesis->author_email }}" type="email" placeholder="email" class="form-control"/></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group"><label class="col-sm-3 control-label" for="phone">Phone</label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9"><input type="tel" name="phone" value="{{ $thesis->author_phone }}" placeholder="08188888888" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>

                                                <h3>Supervisor</h3>

                                                <div class="form-group"><label class="col-sm-3 control-label" for="supervisor">Select <span class="text-danger">*</span></label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-4">
                                                                <select class="form-control" name="supervisor" id="supervisor" required>
                                                                    <option value="">--select--</option>
                                                                    @foreach($supervisors as $supervisor)
                                                                        <option value="{{ $supervisor->id }}" @if($thesis->supervisor_id == $supervisor->id) selected="selected" @endif>{{ $supervisor->name }}</option>
                                                                    @endforeach
                                                                    <option value="new">New</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{--<button class="btn btn-primary btn-sm add-new-supervisor">add another</button>--}}

                                                <div class="new-supervisor hidden">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="scope">Title <span class="text-danger">*</span> </label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-4">
                                                                    <select class="form-control" id="scope" name="title" required>
                                                                        @foreach($prefix as $title2)
                                                                            <option value="{{ $title2 }}">{{ $title2 }}</option>
                                                                        @endforeach
                                                                        <option value="new">others</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group"><label class="col-sm-3 control-label">Name <span class="text-danger">*</span></label>

                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9"><input name="supervisor_name" value="{{ old("supervisor_name") }}" type="text" placeholder="name" class="form-control"/></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group"><label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9"><input name="supervisor_email" value="{{ old("supervisor_email") }}" type="email" placeholder="email" class="form-control"/></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group"><label class="col-sm-3 control-label">Phone</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9"><input name="supervisor_phone" value="{{ old("supervisor_phone") }}" type="tel" placeholder="08188888888" class="form-control"/></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group"><label class="col-sm-3 control-label">Specialization</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9"><input name="supervisor_specialization" value="{{ old("supervisor_specialization") }}" type="text" placeholder="manufacturing" class="form-control"/></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group"><label class="col-sm-3 control-label" for="about">About</label>

                                                        <div class="col-sm-9 controls">
                                                            <div class="row">
                                                                <div class="col-xs-9"><textarea name="about" value="{{ old("about") }}" id="about" rows="3" class="form-control"></textarea></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="about">Document <span class="text-danger">*</span> </label>
                                                    <div class="col-sm-9 controls">
                                                        <div class="row">
                                                            <div class="col-xs-9"><input type="file" name="doc"/> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" name="submit" value="Finish" class="btn btn-green btn-block">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<script src="{{ asset("script/input-mask/jquery.inputmask.js") }}"></script>
<script src="{{ asset("script/input-mask/jquery.inputmask.date.extensions.js") }}"></script>
<script src="{{ asset("script/input-mask/jquery.inputmask.extensions.js") }}"></script>
<script type="text/javascript">
function addNewSupervisor(e) {
    e.preventDefault();
    if ($("select#supervisor").val() === "new") {
        $("div.new-supervisor").removeClass("hidden").slideDown('slow');
        $("select[name='title']").attr("required", "required").focus();
        $("input[name='supervisor_name']").attr("required", "required");
        $("input[name='supervisor_email']").attr("required", "required");
    }
    else {
        $("div.new-supervisor").slideUp("slow").addClass("hidden");
        $("select[name='title']").removeAttr("required");
        $("input[name='supervisor_name']").removeAttr("required");
        $("input[name='supervisor_email']").removeAttr("required");
    }
}
$(document).ready(function() {
    $("body").on("click", "div.btn-group a.view", function(e) {
        e.preventDefault();
        $("div.view-project").toggleClass("hidden");
        if(!$("div.edit-project").hasClass("hidden")) $("div.edit-project").addClass("hidden");
    }).on("click", "div.btn-group a.edit", function(e) {
        e.preventDefault();
        $("div.edit-project").removeClass("hidden");
        if(!$("div.view-project").hasClass("hidden")) $("div.view-project").addClass("hidden");
        if(!$("div.view").hasClass("hidden")) $("div.view").addClass("hidden");
    }).on("click", "button.back", function(e) {
        $("div.view").removeClass("hidden");
        if(!$("div.edit-project").hasClass("hidden")) $("div.edit-project").addClass("hidden");
    });

    $("select#tag").change(function(e) {
        console.log($(this).val());
        if($(this).val() === "new") {
            $("div.new_tag").removeClass("hidden").slideDown('slow');
            $("input[name='tag_name']").attr('required', 'required').focus();
        }
        else {
            $("div.new_tag").slideUp("slow").addClass("hidden");
            $("input[name='tag_name']").removeAttr('required');
        }
    });
    $("select#supervisor").change(function(e) {addNewSupervisor(e)});

    $("[data-mask]").inputmask();
});

</script>
@endsection