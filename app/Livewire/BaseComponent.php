<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class BaseComponent extends Component
{
    use WithPagination;

    public const PER_PAGE = 10;
    public string $search = '';
}