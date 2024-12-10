<div>
    <button 
        wire:click="toggleFavorite" 
        wire:loading.attr="disabled"
        wire:target="toggleFavorite"
        class="btn btn-light like-button position-relative">

        <!-- Show a heart icon based on favorite status -->
        <i class="{{ $isFavorite ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>

        <!-- Show "Loading..." text while the action is being processed -->
        <span wire:loading wire:target="toggleFavorite">Loading...</span>

        <!-- Show favorite count -->
        <span wire:loading.remove class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            {{ $favoriteCount }}
        </span>
    </button>
</div>
