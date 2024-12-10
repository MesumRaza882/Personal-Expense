<div>
    <h2>Edit Category</h2>
    <form wire:submit.prevent="updateCategory">
        @csrf

        <!-- Current Image -->
        @if ($currentImage)
            <a href="{{ $currentImage }}" target="_blank">
                <img src="{{ $currentImage }}" alt="Category Image" width="50" height="50">
            </a>
        @endif

        <!-- New Image Upload -->
        <div class="mb-3">
            <label for="newImage" class="form-label">Upload New Image</label>
            <input type="file" id="newImage" wire:model="newImage" class="form-control @error('newImage') is-invalid @enderror">
            @error('newImage') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror

            @if ($newImage)
                <p>Preview:</p>
                <img src="{{ $newImage->temporaryUrl() }}" alt="New Image Preview" width="50" height="50">
            @endif
        </div>

        <!-- Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name') 
                <div class="invalid-feedback">{{ $message }}</div> 
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
