<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
        return view('user.records.index');
        // errors come
    }

    public function create(Request $request)
    {
        $type = $request->type;
        return view('user.records.create',compact('type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense,udhar',
            'entries' => 'required|array',
            'entries.*.category_id' => 'required|exists:categories,id',
            'entries.*.amount' => 'required|numeric|min:0',
        ]);

        $record = Record::create($request->only('date', 'type', 'status'));

        foreach ($request->entries as $entry) {
            $record->entries()->create($entry);
        }

        return redirect()->route('records.index')->with('success', 'Record added successfully.');
    }

    public function edit(Record $record)
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        return view('records.edit', compact('record', 'categories'));
    }

    public function update(Request $request, Record $record)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|in:income,expense,udhar',
            'entries' => 'required|array',
            'entries.*.category_id' => 'required|exists:categories,id',
            'entries.*.amount' => 'required|numeric|min:0',
        ]);

        $record->update($request->only('date', 'type', 'status'));

        $record->entries()->delete();
        foreach ($request->entries as $entry) {
            $record->entries()->create($entry);
        }

        return redirect()->route('records.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(Record $record)
    {
        $record->delete();
        return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
    }
}
