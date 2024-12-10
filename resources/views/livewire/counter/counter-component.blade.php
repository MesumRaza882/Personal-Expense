<div class="card">
    <div class="card-header">
        <h3>Counter: <small class="bg-dark text-white p-2 rounded-circle">{{ $count }}</small></h3>
    </div>
    <div class="card-body">

        <div class="my-3">
            <label for="stepInput" class="form-label">Set Step Value:</label>
            <input type="number" id="stepInput" class="form-control" wire:model="step" min="1"
                placeholder="Enter step value">

            @if ($errorMessage)
                <div class="text-danger mt-2">{{ $errorMessage }}</div>
            @endif
        </div>

        <div class="btn-group" role="group">
            <button class="btn btn-primary me-2 btn-lg" wire:loading.attr="disabled" wire:click="increment">+</button>
            <button class="btn btn-danger btn-lg" wire:loading.attr="disabled" wire:click="decrement">-</button>
        </div><br>
        <div wire:loading class="mt-2">
            <span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
            Updating...
        </div>
    </div>
</div>
