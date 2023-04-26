<?php

namespace Mates\Status\Http\controllers;

use Backend\Classes\Controller;
use Mates\Status\Http\Resources\StatusResource;
use Mates\Status\Models\Status;

class StatusController extends Controller
{
    public function index() {
        return new StatusResource(Status::all());
    }
}
