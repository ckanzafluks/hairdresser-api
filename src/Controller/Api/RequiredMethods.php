<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

Interface RequiredMethods
{
    public function list();

    public function get(Request $request);

    public function create(Request $request);

    public function update(Request $request);

}
