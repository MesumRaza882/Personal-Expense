<div>

    <div class="d-flex align-items-center justify-content-between my-3">
        <h4>Categories <span class="badge bg-dark rounded-pill">{{ $categoryCounts }}</span></h4>
        <a wire:navigate.hover href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-dark">
            <i class="fa-solid fa-plus"></i> Create
        </a>
    </div>
    <!-- Search Form -->
    <div class="mb-3">
        <div class="row gx-2">
            <div class="col-md-3">
                <input type="text" wire:model.live.debounce.250ms="searchName" placeholder="Search by name" class="form-control">
            </div>
            <div class="col-md-3">
                <select wire:model.live="searchType" class="form-control">
                    <option value="">Select Type</option>
                    <option value="expense">Expense</option>
                    <option value="income">Income</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card card-body pb-0">
        <div class="table-responsive">
            @if ($categoryCounts)
                <!-- Categories Table -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr wire:key="{{ $category->id }}" id="category-row-{{ $category->id }}">
                                <td>{{ $category->id }}
                                    @if ($category->image)
                                        <a href="{{ $category->image->url1 }}" target="_blank">
                                            <img src="{{ $category->image->url1 }}" alt="" width="50"
                                                height="50">
                                        </a>
                                    @endif
                                </td>

                                <td>{{ $category->name }}</td>
                                <td>
                                    <a wire:navigate href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <button onclick="confirmDelete({{ $category->id }})"
                                        class="btn btn-danger btn-sm">Delete</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links('vendor.livewire.bootstrap') }}
            @else
                <div class="alert alert-warning">
                    <p>No data available</p>
                </div>
            @endif
        </div>
    </div>

</div>
