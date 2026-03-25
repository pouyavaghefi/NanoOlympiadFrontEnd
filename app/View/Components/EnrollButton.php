<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EnrollButton extends Component
{
    public $courseId;
    public $price;
    public $private;

    public function __construct($courseId, $price, $private)
    {
        $this->courseId = $courseId;
        $this->price = $price;
        $this->private = $private;
    }

    public function render()
    {
        return view('components.enroll-button');
    }
}
