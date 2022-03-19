<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Projects::orderBy('id', 'asc')->get();
        return response()->json($projects);
    }

    /**
     * Display a listing of the resource by User ID.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByUser(int $userId)
    {
        $projects = Projects::where('user_id', $userId)->orderBy('id', 'asc')->get();
        return response()->json($projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
            'name' => ['required'],
            'category' => ['required'],
            'sub_category' => ['required'],
            'language_framework' => ['required'],
            'img' => ['required', 'image'],
            'url' => ['required'],
        ]);

        if ($request->file()) {
            $name = strtolower(str_replace(
                ' ',
                '',
                $request->file('img')->getClientOriginalName()
            ));

            $name = preg_replace('/[^A-Za-z0-9 _ .-]/', '', $name);

            $request->file('img')->move(
                base_path() . '/public/projects/' . '/',
                $name
            );
            $routePath = '/projects/' . $name;
        }
        Projects::create([
            'name'               => $request->name,
            'category'           => $request->category,
            'sub_category'       => $request->sub_category,
            'language_framework' => $request->language_framework,
            'img'                => $routePath,
            'url'                => $request->url,
            'user_id'            => (int)$request->user_id,
            'is_active'          => true,
        ]);

        return response()->json(['msg' => 'Registered Successfully']);
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
        Projects::destroy($id);
    }

    public function switchActiveProject($id)
    {
        $user = Projects::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return response()->json("Record updated!");
    }
}
