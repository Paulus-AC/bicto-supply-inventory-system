<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableToolbar extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.common.table-toolbar');
    }
}