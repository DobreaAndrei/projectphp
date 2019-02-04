<?php
namespace Framework;


class Controller
{
   private $twig;
   protected $params =[];


   public function __construct($params)
   {
       $this->params = $params;
       $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../app/Views');
       $twigEnvParams = $this->prepareTwigEnvironmentParams();
       $this->twig = new \Twig_Environment($loader, $twigEnvParams);
   }

   public function view(string $viewFile, array $params = [])
   {
       echo $this->twig->render($viewFile, $params);
   }

   private function prepareTwigEnvironmentParams()
   {
       $envParams['cache'] =  __DIR__ . '/../storage/cache/views';

       if(\App\Config::ENV === 'dev') {
           $envParams['cache'] = false;
           $envParams['debug'] = true;
       }

       return $envParams;
   }
}
