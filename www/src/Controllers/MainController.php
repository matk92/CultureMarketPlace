<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;

class MainController
{

    public function home(): void
    {
        // $myUser = new User();
        // $myUser->setFirstName("YVEs");
        // $myUser->setLastName("   SKrZypczYK    ");
        // $myUser->setEmail("Y.skrzypczyk@gmail.com");
        // $myUser->setPwd("Test1234");
        // $myUser->setStatus(1);
        // $myUser->setIsDeleted(false);
        // $myUser->save();

        // $myUser = User::populate(1);
        // var_dump($myUser);
        // $myUser->setFirstName("update 5");
        // $myUser->save();

        new View("Main/home", "front");
    }
}
