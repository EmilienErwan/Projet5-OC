<?php

class View{
    private string $title = "Tom Troc";
    public function __construct(?string $title = null)
    {
        if($title !== null){
            $this->title = $title;
        }
    }
    private function viewPathConstruct(string $title): string{
        return TEMPLATE_VIEW_PATH. $title . ".php";
    }
    private function renderViewTemplate(string $viewPath, array $params = []): string{
        if(file_exists($viewPath)){
            ob_start();
            require($viewPath);
            return ob_get_clean();
        }else{
            throw new Exception("La vue '$viewPath' n'existe pas");
        }
    }
    public function render(string $viewName, array $params = []): void{
        $viewPath = $this->viewPathConstruct($viewName);
        $content = $this->renderViewTemplate($viewPath,$params);
        $title = $this->title;
        ob_start();
        require(MAIN_VIEW_PATH);
        echo ob_get_clean();
    }
}