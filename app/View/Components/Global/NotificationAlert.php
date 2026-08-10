<?php

namespace App\View\Components\Global;

use Illuminate\View\Component;

class NotificationAlert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $heading;
    public $content;
    public $type;
    public $member;

    public function __construct($heading, $content, $member,  $type = 'success')
    {
        $this->heading = $heading;
        $this->content = $content;
        $this->type = $type;
        $this->member = $member;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.global.notification-alert');
    }
}
