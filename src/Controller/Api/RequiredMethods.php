<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

Interface RequiredMethods
{
    public function listAction(Request $request);

    public function createAction(Request $request);

    public function getAction(Request $request);

    public function updateAction(Request $request);

}
