<div>

    <div class="d-flex align-items-center justify-content-between my-3">
        <h4>Categories <span class="badge bg-dark rounded-pill">{{ $categoryCounts }}</span></h4>
        <a wire:navigate.hover href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-dark">
            <i class="fa-solid fa-plus"></i> Create
        </a>
    </div>
    <!-- Search Form -->
    <div class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <input type="text" wire:model.live.debounce.250ms="searchName" placeholder="Search by name" class="form-control">
            </div>
            <div class="col-auto">
                <select wire:model.change="searchType" class="form-control">
                    <option value="">All(Type)</option>
                    <option value="expense">Expense</option>
                    <option value="income">Income</option>
                </select>
            </div>
            <div class="col-auto">
                <select wire:model.change="selectedParentId" class="form-control">
                    <option value="">All(Paarent-Cat)</option>
                    @foreach ($parentCategories as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-auto">
                <select wire:model.change="ParentChild" class="form-control">
                    <option value="">All(P/C)</option>
                    <option value="parent">Parent</option>
                    <option value="child">Child</option>
                </select>
            </div>
            <div class="col-auto">
                <button wire:click="resetFilter" class="btn btn-sm btn-secondary"><i class="fa-solid fa-rotate-left"></i></button>
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
                            <th>ParentCategory</th>
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
                                    @if ($category->parent)
                                    {{ $category->parent->name }}
                                @else
                                    <i class="fa-solid fa-circle-check"></i>
                                @endif
                            </td>
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
