<div>
    <div class="row">
        <div class="col-md-3">
            <label for="type">Type</label>
            <select wire:model.change="type" class="form-control" id="type">
                <option value="">Select Type</option>
                <option value="income">Income</option>
                <option value="expense">Expense</option>
                <option value="udhaar">Udhaar</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="date">Date</label>
            <input type="date" wire:model="date" class="form-control" id="date">
        </div>
    </div>

    <!-- Rows Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Parent Category</th>
                <th>Subcategory</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $index => $row)
                <tr>
                    <td>
                        <select wire:model.change="rows.{{ $index }}.parent_category_id" class="form-control">
                            <option value="">Select Parent</option>
                            @foreach ($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:model.change="rows.{{ $index }}.subcategory_id" class="form-control">
                            <option value="">Select Subcategory</option>
                            @foreach ($row['subcategories'] as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" wire:model.live.debounce.300ms="rows.{{ $index }}.amount"
                            class="form-control">
                    </td>
                    <td>
                        <button wire:click="removeRow({{ $index }})"
                            class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Total and Actions -->
    <div class="d-flex justify-content-between align-items-center">
        <strong>Total: {{ $this->total }}</strong>
        <button wire:click="addRow" class="btn btn-primary">Add Row</button>
        <button wire:click="save" class="btn btn-success">Save</button>
    </div>
</div>
