<?php

namespace App\Http\Schedules;

use App\User;
use App\Http\Controllers\Controller;

class CheckUserExpireScheduler
{

    protected $controller; 


    public function __invoke()
    {
        $this->controller=new Controller;


        $users=User::all();
        

        echo date('Y-m-d H:00:00') . "asdas" . PHP_EOL;



        //$this->controller->sendSMS();
    }
}
