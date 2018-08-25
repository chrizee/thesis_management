<?php

namespace App\Http\Controllers;

use App\Level;
use App\Supervisor;
use App\Tag;
use App\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ThesisController extends Controller
{
    private $viewPath = "thesis.";

    /**
     * ThesisController constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|View
     */
    public function index()
    {
        $thesis = Thesis::latest()->where("published", '1')->get();
        //dd($thesis);
        $data = [
            'thesis' => $thesis,
            'title' => "Projects"
        ];
        return view($this->viewPath."index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|View
     */
    public function create()
    {
        $data = [
            "title" => "Add project",
            'tags' => Tag::all(),
            'supervisors' => Supervisor::all(),
            'levels' => Level::all(),
            "prefix" => Supervisor::$prefix
        ];
        return view($this->viewPath."create")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //create new tag, supervisor,and level here top
        if($request->input("tag") == "new") {
            $tag = (new TagsController())->store($request);
        }else {
            $this->validate($request, ['tag' => 'required|exists:tags,id']);
            $tag = $request->input("tag");
        }

        if($request->input("supervisor") == "new") {
            $supervisor = (new SupervisorsController())->store($request, true);
        }else{
            $this->validate($request, ['supervisor' => "required|int|exists:supervisors,id"]);
            $supervisor = $request->input("supervisor");
        }
        $this->validate($request,[
            'project_name' => "required|string",
            'abstract' => "required|string",
            'authors' => "required|string",
            'phone' => "nullable|numeric",
            'email' => "nullable|email",
            'scope' => "required|int|exists:levels,id",
            'published' => "required|boolean",
            'session1' => "required|date_format:Y",
            'session2' => "required|date_format:Y|after:session1",
            'doc' => "required|mimes:pdf,doc,docx",       //commented out when using dropzone
        ]);

        if($request->hasFile('doc') && $request->file('doc')->isValid()) {
            $extension = $request->file('doc')->getClientOriginalExtension();
            $path = $request->input('project_name')."_".uniqid().".".$extension;
            $request->file('doc')->storeAs("public/project/".$request->input('session1')."-".$request->input('session2'), $path);
        }else {
            return redirect()->back()->withInput();
        }
        $thesis = Thesis::create([
            'name' => $request->input('project_name'),
            'abstract' => $request->input('abstract'),
            'authors' => $request->input('authors'),
            'author_phone' => $request->input('phone'),
            'author_email' => $request->input('email'),
            'tag_id' => $tag,
            'level_id' => $request->input('scope'),
            'supervisor_id' => $supervisor,
            'location' => $path,
            'published' => $request->input("published"),
            'session' => $request->input('session1')."/".$request->input('session2')
        ]);
// todo: use dropzone to implement file upload

        return redirect()->route("thesis.show", $thesis->id)->with("success", "Project added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|View
     */
    public function show($id)
    {
        $thesis = Thesis::findOrFail($id);
        $format = explode(".", $thesis->location)[1];
        $data = [
            'title' => "Project",
            'thesis' => $thesis,
            'tags' => Tag::all(),
            'supervisors' => Supervisor::all(),
            'levels' => Level::all(),
            "prefix" => Supervisor::$prefix,
            'format' => $format
        ];
        if(!empty($thesis) && $thesis->published) {
            return view($this->viewPath."show")->with($data);
        }else {
            return redirect()->back()->withErrors('error', "The requested project does not exist or is not published yet");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //create new tag, supervisor,and level here top
        if($request->input("tag") == "new") {
            $tag = (new TagsController())->store($request);
        }else {
            $this->validate($request, ['tag' => 'required|exists:tags,id']);
            $tag = $request->input("tag");
        }

        if($request->input("supervisor") == "new") {
            $supervisor = (new SupervisorsController())->store($request, true);
        }else{
            $this->validate($request, ['supervisor' => "required|int|exists:supervisors,id"]);
            $supervisor = $request->input("supervisor");
        }
        $this->validate($request,[
            'project_name' => "required|string",
            'abstract' => "required|string",
            'authors' => "required|string",
            'phone' => "nullable|numeric",
            'email' => "nullable|email",
            'scope' => "required|int|exists:levels,id",
            'published' => "required|boolean",
            'session1' => "required|date_format:Y",
            'session2' => "required|date_format:Y|after:session1",
            'doc' => "nullable|mimes:pdf,doc,docx",
        ]);

        $thesis = Thesis::find($id);
        if($request->hasFile('doc') && $request->file('doc')->isValid()) {
            $extension = $request->file('doc')->getClientOriginalExtension();
            $path = $request->input('project_name')."_".uniqid().".".$extension;
            $request->file('doc')->storeAs("public/project/".$request->input('session1')."-".$request->input('session2'), $path);
            $oldFile = str_replace("/", '-', $thesis->session)."/".$thesis->location;
            // delete old file if it exists in the storage system(move it to deleted folder)
            if(Storage::exists("public/project/".$oldFile)) {
                Storage::move('public/project/'.$oldFile, "public/project/deleted/".$oldFile);
            }
            $thesis->location = $path;
        }

        $thesis->name = $request->input('project_name');
        $thesis->abstract = $request->input('abstract');
        $thesis->authors = $request->input('authors');
        $thesis->author_phone = $request->input('phone');
        $thesis->author_email = $request->input('email');
        $thesis->tag_id = $tag;
        $thesis->level_id = $request->input('scope');
        $thesis->supervisor_id = $supervisor;
        $thesis->published = $request->input("published");
        $thesis->session = $request->input('session1')."/".$request->input('session2');

        $thesis->save();
        return redirect()->route("thesis.show", $id)->with("success", "Project updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thesis = Thesis::find($id);
        $oldFile = str_replace("/", '-', $thesis->session)."/".$thesis->location;
        // delete old file if it exists in the storage system(move it to deleted folder)
        if(Storage::exists("public/project/".$oldFile)) {
            Storage::move('public/project/'.$oldFile, "public/project/deleted/".$oldFile);
        }
        $thesis->delete();
        return redirect()->back()->with('success', "Project deleted");
    }

    public function search(Request $request, $id) {
        $search = explode("/", $request->path())[1];
        switch ($search) {
            case "level" :{
                $param = 'level_id';
                $title = Level::find($id);
                if(!empty($title)) $title = $title->name;
                break;
            }
            case "tag": {
                $param = 'tag_id';
                $title = Tag::find($id);
                if(!empty($title)) $title = $title->name;
                break;
            }
            case "session" :{
                $param = 'session';
                $title = $id." session";
                $id = str_replace('-','/',$id);
                break;
            }
            default: {
                return redirect()->back()->withErrors("Invalid request");
            }
        }

        $thesis = Thesis::latest()->where($param, $id)->get();

        $data = [
            'thesis' => $thesis,
            'title' => "Projects in ".$title,
        ];
        return view($this->viewPath."index")->with($data);
    }

}
