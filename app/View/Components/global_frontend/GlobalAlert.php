<?php

namespace App\View\Components\global_frontend;

use Illuminate\View\Component;

class GlobalAlert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $heading;
    public $content;
    public function __construct($content = null, $heading = null)
    {
        $this->content = $content;
        $this->heading = $heading;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.global_frontend.global-alert');
    }
}
