<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\CategoryType;
use App\Models\ClassJob;

class FrontendSearchForm extends Component
{
    public $selectedBaseClass = null;
    public $selectedClass = null;
    public $selectedCategory = null;
    public $categoryDetail = null;
    public $categoryType = null;
    public $classes = null;
    public $job_id;

    public function render()
    {
        return view('livewire.frontend-search-form', [
            'categories' => Category::select('id', 'name')->get(),
            'base_classes' => ClassJob::select('id', 'name')->whereNull('parent_id')->get()
        ]);
    }

    public function updatedSelectedBaseClass($class_id)
    {
        $this->classes = ClassJob::where('parent_id', $class_id)->select('id', 'name')->get();
        $this->classId = $class_id;
    }

    public function updatedSelectedClass($class_id)
    {
        $this->job_id = $class_id;
    }

    public function updatedSelectedCategory($category_id)
    {
        $this->categoryDetail = CategoryDetail::where('category_id', $category_id)->where('job_id', $this->job_id)->select('id', 'name')->get();
        $this->categoryType = CategoryType::where('category_id', $category_id)->select('id', 'name')->get();

        $this->categoryId = $category_id;
    }
}
