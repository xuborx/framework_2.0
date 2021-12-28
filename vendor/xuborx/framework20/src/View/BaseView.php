<?php
declare(strict_types=1);

namespace Xuborx\Framework\View;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseView
{

    /**
     * @var self|null
     */
    private static $instance = null;

    /**
     *
     */
    private function __construct(){}

    /**
     * @return BaseView|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $templateName
     * @param array $data
     * @return void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $templateName, array $data = []): void
    {
        $templateName = trim($templateName) . '.twig';
        $filesystemLoader = new FilesystemLoader(VIEW_DIR);
        $twig = new Environment($filesystemLoader, ['cache' => CACHE_TEMPLATES]);

        if (!file_exists(VIEW_DIR . '/' . $templateName)) {
            echo 'Template not found<br>';
            return;
        }

        $template = $twig->load($templateName);
        echo $template->render($data);
    }

}
