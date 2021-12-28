<?php
declare(strict_types=1);

namespace App\Controllers;

use Xuborx\Localization\Parser\TranslationsStorage;

class StartController extends MainController
{

    public function indexAction(): void
    {
        $data = [
            'hello' => TranslationsStorage::get('Hello', 'en'),
            'welcomeMessage' => TranslationsStorage::get('WelcomeMessage', 'en'),
            'documentation' => TranslationsStorage::get('Documentation', 'en')
        ];

        $this->view->render('start', $data);
    }

}
