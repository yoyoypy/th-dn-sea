<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\ClassJob;
use App\Models\CategoryType;
use App\Models\CategoryDetail;

class ProductCreateForm extends Component
{
    public $selectedClass = null;
    public $selectedCategory = null;
    public $categoryType = null;
    public $categoryDetail = null;
    public $categoryId;

    public function render()
    {
        return view('livewire.product-create-form', [
            'categories'    => Category::select('id', 'name')->get(),
            'classes'       => ClassJob::whereNotNull('parent_id')->select('id', 'name')->get()
        ]);
    }

    public function updatedSelectedCategory($category_id)
    {
        $this->categoryType = CategoryType::where('category_id', $category_id)->select('id', 'name')->get();
        $this->categoryId = $category_id;
    }

    public function updatedSelectedClass($class_id)
    {
        $this->categoryDetail = CategoryDetail::where('job_id', $class_id)->where('category_id', $this->categoryId)->select('id', 'name')->get();
    }
}
