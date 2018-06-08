<?php
/**
 * User: Serhii T.
 * Date: 6/4/18
 */

namespace App\Controller;

class Controller
{
    /** @var string  */
    protected static $dirViews = 'views/';

    private static $status = [
      400 => '400 Bad Request',
      404 => '404 Not Found',
      405 => '405 Method Not Allowed',
    ];

    /**
     * @param string $viewName
     * @param  int $statusCode
     * @return string
     */
    public static function renderError(string $content, int $statusCode = 404): string
    {
        $viewFile = self::$dirViews.'error.php';
        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        ob_end_clean();

        ob_start();
        $status = sprintf('%s %s', $_SERVER['SERVER_PROTOCOL'], self::$status[$statusCode]);
        header($status, true, $statusCode);
        require self::$dirViews.'layout.php';

        return ob_get_flush();
    }

    /**
     * @param string $viewName
     * @param array $params
     * @return string
     */
    protected function renderLayout($viewName = '', array $params = []): string
    {
        $viewFile = self::$dirViews.$viewName.'.php';
        extract($params, EXTR_REFS);

        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        ob_end_clean();

        ob_start();
        header($_SERVER['SERVER_PROTOCOL']. ' 404 Not Found', true, 404);
        require self::$dirViews.'layout.php';

        return ob_get_flush();
    }

    /**
     * @param string $content
     * @return string
     */
    protected function render(string $content): string
    {
        ob_start();
        require self::$dirViews.'layout_empty.php';

        return ob_get_flush();
    }
}
