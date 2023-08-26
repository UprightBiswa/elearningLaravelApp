<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Note;

use App\Models\Role;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Note::with('Classes')->get();
        return view('Admin.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all(); // Fetch classes from your model
        return view('Admin.notes.create', compact('classes'));
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
            'note_subject' => 'required',
            'note_date' => 'required',
            'note_file' => 'required|file|mimes:pdf,doc,docx',
            'class_id' => 'required|exists:classes,id',
        ]);

        $noteData = $request->except('note_file');

        if ($request->hasFile('note_file')) {
            $file = $request->file('note_file');
            $filePath = $file->store('notes', 'public');
            $noteData['note_file'] = $filePath;
        }

        $noteData['note_date'] = Carbon::createFromFormat('d F, Y', $noteData['note_date'])->format('Y-m-d');
        Note::create($noteData);

        return redirect('admin/notes')->with('status', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {

        return view('Admin.notes.show', compact('note'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $note = Note::findOrFail($id);
    $classes = Classes::all(); // Fetch classes from your model
    return view('Admin.notes.edit', compact('note', 'classes'));
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
        $request->validate([
            'note_subject' => 'required',
            'note_date' => 'required',
            'class_id' => 'required|exists:classes,id',
        ]);

        $noteData = $request->except(['note_file', '_method', '_token']);

        if ($request->hasFile('note_file')) {
            $file = $request->file('note_file');
            $filePath = $file->store('notes', 'public');
            $noteData['note_file'] = $filePath;
        }

        $noteData['note_date'] = Carbon::createFromFormat('d F, Y', $noteData['note_date'])->format('Y-m-d');

        $note = Note::findOrFail($id);
        $note->update($noteData);

        return redirect('admin/notes')->with('status', 'Note updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect('admin/notes')->with('status', 'note member deleted successfully.');
    }

}


