<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */

    //Esto hace que cargue la vista que hayas diseñado en el (/view/layout/app.blade.php)
    public function render()
    {
        return view('layouts.app');
    }
}
