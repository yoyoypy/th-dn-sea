<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\ClassJob;

class FrontendSearchForm extends Component
{
    public function render()
    {
        return view('livewire.frontend-search-form', [
            'categories' => Category::select('id', 'name')->get(),
            'base_classes' => ClassJob::select('id', 'name')->whereNull('parent_id')->get()
        ]);
    }
}
