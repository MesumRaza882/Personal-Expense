<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Record;
use App\Models\Entry;

class CreateRecord extends Component
{
    public $type = null; // Record type: udhaar, expense, income
    public $categories = []; // Parent categories based on type
    public $subcategories = []; // Subcategories based on parent category
    public $rows = []; // Table rows
    public $date; // Default date

    public function mount($type)
    {
        $this->type = $type;
        $this->date = Carbon::today()->format('Y-m-d');
        $this->categories = Category::where('type', $this->type)->whereNull('parent_id')->get();
    }

    public function updatedType()
    {
        $this->categories = Category::where('type', $this->type)->whereNull('parent_id')->get();
        $this->subcategories = [];
    }

    public function updatedRows($value, $key)
    {
        // Dynamic update when a parent category is selected to load subcategories
        if (str_contains($key, '.parent_category_id')) {
            $index = explode('.', $key)[0];
            $this->rows[$index]['subcategories'] = Category::where('parent_id', $value)->get();
        }
    }

    public function addRow()
    {
        $this->rows[] = [
            'parent_category_id' => null,
            'subcategory_id' => null,
            'amount' => null,
            'subcategories' => [],
        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Re-index rows
    }

    public function getTotalProperty()
    {
        return array_sum(array_column($this->rows, 'amount'));
    }



    public function save()
    {
        // Validate input data
        $this->validate([
            'type' => 'required|in:income,expense,udhaar',
            'date' => 'required|date',
            'rows.*.amount' => 'required|numeric|min:0',
            'rows.*.parent_category_id' => 'required|exists:categories,id',
            'rows.*.subcategory_id' => 'nullable|exists:categories,id',
        ]);

        // Calculate total amount
        $totalAmount = $this->total;

        // Update or create a Record
        $record = Record::updateOrCreate(
            [
                'date' => $this->date,
                'type' => $this->type,
            ],
            []
        );


        // Loop through rows and save entries
        foreach ($this->rows as $row) {
            Entry::create([
                'amount' => $row['amount'],
                'record_id' => $record->id,
                'category_id' => $row['subcategory_id'] ?: $row['parent_category_id'], // Use subcategory if present
            ]);
        }

        // Reset the form
        $this->reset(['type', 'date', 'rows']);
        $this->rows = [
            [
                'parent_category_id' => null,
                'subcategory_id' => null,
                'amount' => null,
                'subcategories' => [],
            ],
        ];

        $this->dispatch('showToast', 'success', 'Record saved successfully!');
    }


    public function render()
    {
        return view('livewire.create-record');
    }
}
