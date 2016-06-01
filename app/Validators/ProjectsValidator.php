<?php

namespace NettworkProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectsValidator extends LaravelValidator {

    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required|date',
   ];

}