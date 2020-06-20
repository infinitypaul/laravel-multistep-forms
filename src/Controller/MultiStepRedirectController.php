<?php

namespace Infinitypaul\MultiStep\Controller;

class MultiStepRedirectController
{
    public function __invoke(\Illuminate\Http\Request $request)
    {
        return redirect($request->url().'/1');
    }
}
