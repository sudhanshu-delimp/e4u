<?php

namespace App\View\Components\global_frontend;

use Illuminate\View\Component;

class publications_alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $content;
    public function __construct($content = null)
    {
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.global_frontend.publications_alert');
    }
}
