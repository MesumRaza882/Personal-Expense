<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchBarComponent extends Component
{
    public $route;
    public $placeholder;

    public function __construct($route, $placeholder = 'Search for books...')
    {
        $this->route = $route;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.search-bar-component');
    }
}
