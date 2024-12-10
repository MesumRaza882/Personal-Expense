<div>
    <button wire:click="toggleFavorite" wire:loading.attr="disabled" wire:target="toggleFavorite"
        class="btn btn-sm btn-outline-danger" wire:click="toggleFavorite">

        <span wire:loading wire:target="toggleFavorite">Loading...</span>
        
        <span wire:loading.remove>
            <i class="fa fa-heart text-danger"></i> Unfavorite
        </span>
    </button>
</div>
