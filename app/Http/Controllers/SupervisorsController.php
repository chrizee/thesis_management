<?php

namespace App\Http\Controllers;

use App\Supervisor;
use Illuminate\Http\Request;

class SupervisorsController extends Controller
{
    private $viewPath = "supervisors.";

    /**
     * SupervisorsController constructor.
     * @internal param string $viewPath
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $supervisors = Supervisor::latest()->get();
        return view($this->viewPath."index")->with($supervisors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param bool $fromThesis
     * @return \Illuminate\Http\Response|int
     */
    public function store(Request $request, $fromThesis = false)
    {
        $this->validate($request, [
            'supervisor_name' => "required|string|unique:supervisors,name",
            'title' => "required|string",
            'supervisor_phone' => "nullable|numeric|unique:supervisors,phone",
            'supervisor_email' => "required|email|unique:supervisors,phone",
            'specialization' => "nullable|string",
            "about" => "nullable|string"
        ]);

        $supervisor = Supervisor::create([
            'name' => $request->input('supervisor_name'),
            'title' => $request->input('title'),
            'phone' => $request->input('supervisor_phone'),
            'email' => $request->input('supervisor_email'),
            'specialization' => $request->input('specialization'),
            'about' => $request->input('about'),
        ]);
        if($fromThesis) return $supervisor->id;
        return redirect()->route("supervisors.show", $supervisor->id)->with("success", "Supervisor added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $supervisor = Supervisor::find($id);
        $data = [
            'supervisors' => $supervisor
        ];
        if(!empty($supervisor)) {
            return view($this->viewPath . "show")->with($data);
        }else {
            return redirect()->back()->with("error", "The requested data does not exist");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => "required|string|unique:supervisors",
            'title' => "required|string",
            'phone' => "nullable|numeric|unique:supervisors",
            'email' => "required|email|unique:supervisors",
            'specialization' => "nullable|string",
            "about" => "nullable|string"
        ]);

        $supervisor = Supervisor::find($id);

        $supervisor->name = $request->input('name');
        $supervisor->title = $request->input('title');
        $supervisor->phone = $request->input('phone');
        $supervisor->email = $request->input('email');
        $supervisor->specialization = $request->input('specialization');
        $supervisor->about = $request->input('about');

        return redirect()->route("supervisors.show", $supervisor->id)->with("success", "Supervisor updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supervisor = Supervisor::find($id);
        $supervisor->delete();
        return redirect()->route('supervisors.index')->with('success', "Supervisor deleted");
    }
}
