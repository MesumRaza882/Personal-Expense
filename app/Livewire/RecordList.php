<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Record, Category};
use Carbon\Carbon;

class RecordList extends Component
{
    public $type = null; // Filter by type
    public $startDate = null; // Start date for date range filter
    public $endDate = null; // End date for date range filter
    public $categories = []; // Available categories based on type
    public $selectedCategory = null; // Selected category for filtering
    public $subcategories = []; // Available subcategories based on selected category

    public function mount()
    {
        $this->categories = Category::whereNull('parent_id')->get();
    }

    public function updatedType()
    {
        $this->selectedCategory = null;
        $this->subcategories = [];
        $this->categories = Category::where('type', $this->type)->whereNull('parent_id')->get();
    }

    public function updatedSelectedCategory()
    {
        $this->subcategories = Category::where('parent_id', $this->selectedCategory)->get();
    }

    public function createRecord($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        $query = Record::query()
            ->with(['entries', 'entries.category'])
            ->when($this->type, function ($q) {
                $q->WhereIf('type', '=', $this->type);
            })
            ->FilterByDateRange($this->startDate, $this->endDate) // Using the global  for date range
            ->when($this->selectedCategory, function ($q) {
                $q->whereHas('entries', function ($query) {
                    $query->WhereIf('category_id', '=', $this->selectedCategory);
                });
            });

        $records = $query->get();

        return view('livewire.record-list', [
            'records' => $records,
        ]);
    }
}
