<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;

class CategoryList extends Component
{
    #[Url(as: 'name')]
    public $searchName;
    #[Url(as: 'type')]
    public $searchType;
    #[Url(as: 'parent')]
    public $selectedParentId;
    #[Url(as: 'def')]
    public $ParentChild;

    public $key;
    public $categoryCounts;

    use WithPagination;

    public function updated($name, $value)
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->reset();
    }

    #[Computed]
    public function parentCategories()
    {
        return Category::whereNull('parent_id')->get(['id','name']);
    }
 

    #[On('delete-category')]
    public function deleteCategory(int $categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {

            // Check and delete the associated image
            if ($category->image) {
                Storage::disk('public')->delete($category->image->url);
                $category->image()->delete();
            }

            $category->delete();
            $this->dispatch('categoryDeleted', $categoryId);
            $this->dispatch('showToast', 'success', 'Category deleted   successfully!');
        } else {
            $this->dispatch('showToast', 'success', 'Category not found!');
        }
    }
    public function render()
    {
        $query = Category::query()
            ->with('image')
            ->when($this->searchName, function ($query) {
                $query->where('name', 'LIKE', "%{$this->searchName}%");
            })
            ->when($this->searchType, function ($query) {
                $query->where('type', '=', $this->searchType);
            })
            ->when($this->ParentChild, function ($query) {
                if ($this->ParentChild === 'parent') {
                    $query->whereNull('parent_id');
                } elseif ($this->ParentChild === 'child') {
                    $query->whereNotNull('parent_id');
                }
            })->when($this->selectedParentId, function ($query) {
                $query->where('parent_id', $this->selectedParentId);
            });
    
        $categories = $query->latest()->paginate(10);
    
        // Use total() to get the total count
        $this->categoryCounts = $categories->total();
    
        return view('livewire.category.category-list', [
            'categories' => $categories,
            'parentCategories' => $this->parentCategories,
            'total' => $this->categoryCounts,
        ]);
    }
    
}
