<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;
use \App\Models\Project;
use DB;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::with('groups')->first();
        if($project){
            $groups = Project::join('groups', 'projects.id', '=', 'groups.project_id')
            ->join('group_student', 'groups.id', '=', 'group_student.group_id')
            ->leftJoin('students', 'group_student.student_id', '=', 'students.id')
            ->get();
//             dd($groups);

            $students = Student::with('groups')->get();
//            dd($students);

            $studentsWithoutGroup = Student::whereDoesntHave('groups')->get();
//            dd($studentsWithoutGroup);
            return view('project.index', compact('project', 'groups', 'students', 'studentsWithoutGroup'));
        }
        return redirect()->route('projects.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Project::with('groups')->first()) {
            return redirect()->route('projects.index');
        }
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'project_name' => 'required',
            'group_count' => 'bail|required|gt:0',
            'student_count' => 'bail|required|gt:0',
        ]);
        $projectId = Project::insertGetId([
            'project_name' => $request->project_name,
            'group_count' => $request->group_count,
            'student_count' => $request->student_count,
        ]);
        foreach (range(1, $request->group_count) as $group) {
            $groupId = Group::insertGetId([
                'group_name' => 'Group #'.$group,
                'project_id' => $projectId,
            ]);
            foreach (range(1, $request->student_count) as $student){
                DB::table('group_student')->insert([
                    'group_id' => $groupId,
                    'student_id' => 0,
                ]);
            }
        }
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
