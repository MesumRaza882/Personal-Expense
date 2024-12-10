<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Storage;

class CategoryList extends Component
{
    #[Url] 
    public $searchName;

    #[Url] 
    public $searchType;
    public $key;
    public $categoryCounts;

    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    // Reset pagination when a filter changes
    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <p class="text-center">loading categories ...</p>
        </div>
        HTML;
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
                $query->whereif('name', 'LIKE', $this->searchName);
            })
            ->when($this->searchType, function ($query) {
                $query->whereif('type', '=', $this->searchType);
            });
        $this->categoryCounts = $query->count();
        $categories = $query->latest()->paginate(5);
        return view('livewire.category.category-list', ['categories' => $categories]);
    }
}
