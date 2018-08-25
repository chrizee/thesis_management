@extends("layouts.app2")

@section('content')
    <div class="page-content">
            <div class="row mbl">
                <div class="col-md-12">
                    <a href="{{ route("thesis.index") }}" class="btn btn-success btn-sm" > <i class="fa fa-search"></i> Projects</a>
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <form action="{{ route("thesis.store") }}" class=" form-horizontal" id="form1" method="post" enctype="multipart/form-data"><h3>Project Info</h3>
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Project name <span class="text-danger">*</span> </label>
                                    <div class="col-sm-9 controls">
                                        <div class="row">
                                            <div class="col-xs-9"><input name="project_name" value="{{ old("project_name") }}" type="text" placeholder="Design and construction of ..." class="form-control" required/></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="abstract">Abstract <span class="text-danger">*</span></label>
                                    <div class="col-sm-9 controls">
                                        <div class="row">
                                            <div class="col-xs-9"><textarea rows="3" id="abstract" name="abstract" value="{{ old("abstract") }}" class="form-control" required></textarea></div>
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
                                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
                                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
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
                                                <div class="radio"><label class="radio-inline"><input type="radio" value="1" name="published" checked="checked"/>&nbsp;
                                                        Yes</label><label class="radio-inline"><input type="radio" value="0" name="published"/>&nbsp;
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
                                                <input name="session1" style="display: inline; width: 40%;" value="{{ old("session1") }}" type="text"  id="session" class="form-control" required data-inputmask="'alias': 'yyyy'" data-mask /> <span style="font-size: 2em">/</span>
                                                <input name="session2" style="display: inline; width: 40%;" value="{{ old("session2") }}" type="text"  id="session2" class="form-control" required data-inputmask="'alias': 'yyyy'" data-mask />
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
                                            <div class="col-xs-9"><input name="authors" value="{{ old("authors") }}" type="text" placeholder="name" id="author_name" class="form-control" required /></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="email">Email</label>
                                    <div class="col-sm-9 controls">
                                        <div class="row">
                                            <div class="col-xs-9"><input name="email" value="{{ old("email") }}" type="email" placeholder="email" class="form-control"/></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group"><label class="col-sm-3 control-label" for="phone">Phone</label>
                                    <div class="col-sm-9 controls">
                                        <div class="row">
                                            <div class="col-xs-9"><input type="tel" name="phone" value="{{ old("phone") }}" placeholder="08188888888" class="form-control"/></div>
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
                                                    <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
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
                                                <div class="col-xs-9"><input name="supervisor_name" value="{{ old("supervisor_name") }}" type="text" placeholder="name" class="form-control" required/></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-3 control-label">Email <span class="text-danger">*</span></label>
                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-9"><input name="supervisor_email" value="{{ old("supervisor_email") }}" type="email" placeholder="email" class="form-control" required/></div>
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

                                <div class="form-group fallback">
                                    <label class="col-sm-3 control-label" for="about">Document <span class="text-danger">*</span> </label>
                                    <div class="col-sm-9 controls">
                                        <div class="row">
                                            <div class="col-xs-9"><input type="file" name="doc" required/> </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" form="form1" class="btn btn-green btn-block">Finish</button>
                            </form>
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
        /*Dropzone.options.form1 = {
            paramName: "doc",
            maxFileSize: 1,
            uploadMultiple: false,
            maxFiles: 1,
            dictDefaultMessage: "upload project doc here (pdf or word document)"
        };*/
        $("select#tag").change(function(e) {
            //console.log($(this).val());
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

//      $("body").on("click", "button.add-new-supervisor", function(e) {addNewSupervisor(e)});
        $("[data-mask]").inputmask();
    });

</script>
@endsection