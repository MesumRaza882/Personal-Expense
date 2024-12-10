<div>
    <div class="mb-3">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="createRecordDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                Create Record
            </button>
            <ul class="dropdown-menu" aria-labelledby="createRecordDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('records.create', ['type' => 'income']) }}">Income</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('records.create', ['type' => 'expense']) }}">Expense</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('records.create', ['type' => 'udhaar']) }}">Udhaar</a>
                </li>
            </ul>
        </div>
    </div>



    <!-- Filters -->
    <div class="row mb-3">
        <div class="col-md-3">
            <select wire:model.live="type" class="form-control">
                <option value="">All Types</option>
                <option value="income">Income</option>
                <option value="expense">Expense</option>
                <option value="udhar">Udhar</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" wire:model.live="startDate" class="form-control" placeholder="Start Date">
        </div>
        <div class="col-md-3">
            <input type="date" wire:model.live="endDate" class="form-control" placeholder="End Date">
        </div>
        <div class="col-md-3">
            <select wire:model.live="selectedCategory" class="form-control">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 mt-2">
            <select wire:model="selectedSubCategory" class="form-control">
                <option value="">All Subcategories</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Record List -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Total Amount</th>
                <th>Entries</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $record)
                <tr>
                    <td>{{ $record->date }}</td>
                    <td>
                        <span
                            class="pb-2 badge bg-{{ $record->type === 'income' ? 'success' : ($record->type === 'expense' ? 'secondary' : 'info') }}">
                            {{ $record->type }}
                        </span>
                    </td>
                    <td>{{ $record->entries->sum('amount') }}</td>
                    <td>
                        @foreach ($record->entries as $entry)
                            <div>
                                <strong><span class="text-muted me-2 small">{{$entry->category->parent ? $entry->category->parent->name : ''}}</span>{{ $entry->category->name }}</strong>: {{ $entry->amount }}
                            </div>
                        @endforeach
                        <button class="btn btn-sm btn-info">View Detail</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
