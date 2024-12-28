<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CategoryEdit extends Component
{
    use WithFileUploads;

    public $categoryId;
    public $name;
    public $currentImage;
    public $newImage;

    public function mount($categoryId)
    {
        $category = Category::with('image')->findOrFail($categoryId);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->currentImage = $category->image->url1 ?? null;
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'newImage' => 'nullable|image|max:1024',
        ]);

        $category = Category::findOrFail($this->categoryId);
        $category->name = $this->name;
        $category->save();

        // Update image if a new one is uploaded
        if ($this->newImage) {
            // Delete the old image if it exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image->url);
                $category->image->delete();
            }

            // Upload and save the new image
            $path = $this->newImage->store('categories', 'public');
            $category->image()->create([
                'url' => $path,
                'type' => 'cover',
            ]);

            $this->currentImage = $path;
        }
        $this->dispatch('showToast', 'success', 'Category updated successfully!');

    }

    public function render()
    {
        return view('livewire.category.category-edit');
    }
}
