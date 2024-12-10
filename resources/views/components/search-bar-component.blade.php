<div class="row my-4">
    <div class="col-md-6 mx-auto">
        <form action="{{ route($route) }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                 placeholder="{{$placeholder}}" aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>
