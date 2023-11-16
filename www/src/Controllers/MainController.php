<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class MainController
{

    public function home(): void
    {
        // $myUser = new User();
        // $myUser->setFirstname("YVEs");
        // $myUser->setLastname("   SKrZypczYK    ");
        // $myUser->setEmail("Y.skrzypczyk@gmail.com");
        // $myUser->setPwd("Test1234");
        // $myUser->save();

        // $myUser = (new User());
        // $myUser->setId(8);
        // $myUser->populate();

        // $myUser->setFirstname("update");
        // $myUser->save();

        new View("Main/home", "front");
    }
}
