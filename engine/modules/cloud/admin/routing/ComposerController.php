<?php
require_once ROOT_DIR.'/symfony-shell.php';
use Routing\Router;

class ComposerController
{
    /**
     * @var \Routing\Router
     */
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function mainAction()
    {
        global $cdle;
        echoheader($cdle['title'], $cdle['description']);
        if(isset($_POST['send'])){
            $output = array();
            exec($_POST['command'], $output);
            foreach ($output as $key => $value) {
                echo $value."<br>";
            }
        }
        echo self::render('composer');
        echofooter();
    }
        
    public function ajaxAction(){

        $composer_dir = '/home/ziryanov/dle';
        putenv("COMPOSER_HOME=$composer_dir");
        $command = ROOT_DIR."/composer.phar require fenom\fenom 2>&1";

        ob_start();
        system($command);
        $output = ob_get_clean();
        var_dump($output);
    }

    protected function render($template, array $vars = array())
    {
        $root = ADMINDIR . '/views/';

        $templatePath = $root . $template . '.php';

        if (!is_file($templatePath)) {
            throw new \InvalidArgumentException(sprintf('Template "%s" not found in "%s"', $template, $templatePath));
        }

        extract($vars);

        $router = $this->router;

        ob_start();
        ob_implicit_flush(0);

        try {
            require($templatePath);
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }

        return ob_get_clean();
    }
}