<div>
    <h4 class="my-3">Create Category / Sub-Category <a data-turbo="false" wire:navigate href="{{route('categories.index')}}" class="btn btn-sm btn-outline-dark ms-2"><i class="fs-4 fa-solid fa-arrow-left"></i></a></h4>

    <!-- Nav Tabs for Category and Sub-Category -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link {{ $tab === 'category' ? 'active' : '' }}"
            wire:click="$set('tab', 'category')">Category</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link {{ $tab === 'subcategory' ? 'active' : '' }}"
            wire:click="$set('tab', 'subcategory')">Sub-Category</button>
        </li>
    </ul>

    <div class="mt-3 card card-body">
        <form wire:submit.prevent="save">
            <div class="row mt-2">
                <div class="col-md-9">
                    <label for="photo" class="form-label fw-bold">Upload Image</label>
                    <input id="photo" class="form-control" type="file" wire:model="photo">
                    <div wire:loading wire:target="photo" class="mt-1">Uploading...</div>
                    @error('photos.*')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                @if ($photo)
                    <div class="col-md-3">
                        <img src="{{ $photo->temporaryUrl() }}" class="img-fluid" style="height: 80px; width:80px;">
                    </div>
                @endif
            </div>


            <div class="row gy-2 my-3">
                <!-- Category Name Input -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Category Name</label>
                        <input type="text" id="name" wire:model="name"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Type Select -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Select Type</label>
                        <select id="type" wire:model.live="type"
                            class="form-control @error('type') is-invalid @enderror">
                            <option value="">Select</option>
                            <option value="expense">Expense</option>
                            <option value="income">Income</option>
                            <option value="udhaar">Udhaar</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Conditional Fields for Sub-Category -->
                <div class="col-md-6">
                    @if ($tab === 'subcategory')
                        <!-- Parent Category Select -->
                        <div class="mb-3">
                            <label for="parent_id" class="fw-bold form-label">Select Parent Category</label>
                            <select id="parent_id" wire:model="parent_id"
                                class="form-control @error('parent_id') is-invalid @enderror">
                                <option value="">Select</option>
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="m-auto d-block btn btn-dark">Create {{ ucfirst($tab) }}</button>
        </form>
    </div>
</div>
