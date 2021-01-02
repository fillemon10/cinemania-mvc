<?php

namespace app\core;

class View
{
    public string $title = '';

    public function renderView($view, $params = [])
    {
        $view_content = $this->renderOnlyView($view, $params);
        $layout_content = $this->layout_content();

        return str_replace('{{content}}', $view_content, $layout_content);
    }

    public function renderContent($view_content)
    {
        $layout_content = $this->layout_content();
        return str_replace('{{content}}', $view_content, $layout_content);
    }

    public function layout_content()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
