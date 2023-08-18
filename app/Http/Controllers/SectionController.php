<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view("sections.index", compact("sections"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',
        ], [
            'section_name.required' => 'يرجى ادخال القسم',
            'section_name.unique' => 'الاسم مسجل مسبقا',
            'description.required' => 'يرجى ادخال الوصف',
        ]);

        $section = Section::where('section_name', '=', $request->input("section_name"))->exists();
        if ($section) {
            return redirect()->route('sections.index')->with('error', 'خطا القسم مسجل مسبقا');
        } else {
            $section = new Section();
            $section->section_name = $request->input("section_name");
            $section->description = $request->input("description");
            $section->Create_by = (Auth::user()->name);
            $section->save();
            return redirect()->route('sections.index')->with('success', 'تم إنشاء القسم بنجاح');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}
