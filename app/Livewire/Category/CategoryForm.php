<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class CategoryForm extends Component
{

    public $tab = 'category';
    public $name;
    public $type;
    public $parent_id;
    public $categories = [];
    public $photo;

    use WithFileUploads;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }

    public function updatedType()
    {
        // Call getSubcategories whenever 'type' changes
        $this->getSubcategories();
    }

    public function getSubcategories()
    {
        // Update categories based on the selected type
        $this->categories = Category::whereType($this->type)
            ->whereNull('parent_id')
            ->pluck('name', 'id');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required_if:tab,subcategory|nullable|exists:categories,id',
            'type' => 'required',
        ]);

        
        $category = new Category();
        $category->name = $this->name;
        $category->user_id = Auth::id();
        $category->type = $this->type;
        
        if ($this->tab === 'subcategory' && $this->parent_id) {
            $category->parent_id = $this->parent_id;
        }
        $category->save();
        
        if($this->photo){
            $path = $this->photo->store('categories', 'public');
            $category->image()->create([
                'url' => $path,
                'type' => 'cover',
            ]);
        }

        $this->reset(['name', 'type', 'parent_id', 'photo','categories']);

        $this->dispatch('showToast', 'success', 'Category created successfully!');
    }

    public function render()
    {
        return view('livewire.category.category-form');
    }
}
