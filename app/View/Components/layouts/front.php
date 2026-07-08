<?php

namespace App\View\Components\layouts;

use App\Models\Project;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class front extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public  $recentProjects =null ,public string $title="",)
    {
        //
        $this->recentProjects=Project::orderBy('created_at', 'desc')->take(3)->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.front',['title'=>$this->title]);
    }
}
