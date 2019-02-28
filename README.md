# evote-movie-2019-10-functions-into-controller-class

Part of the progressive Movie Voting website project at:
https://github.com/dr-matt-smith/evote-movie-2019

The project has been refactored as follows:

- in directory `/src` rename file `controllerFunctions.php` to `MainController.php`, and change it in the following ways:

    - add `namespace` and `class` statements at the top, and move all the functions into the body of the class
    
    - rename each function, removing the `Action` suffix
    
        - since `list` is a special word in PHP, change this method name to `listMovies()`
    
    - make each method `public`

    ```php
      namespace Mattsmithdev;
      
      class MainController
      {
          function home()
          {
              $pageTitle = 'home';
              $homePageStyle = "current_page";
              require_once __DIR__ . '/../templates/index.php';
          }
      
          function about()
          {
              $pageTitle = 'about';
              $aboutPageStyle = "current_page";
              require_once __DIR__ . '/../templates/about.php';
          }
      
      
          function contact()
          {
              $pageTitle = 'contact';
              $contactPageStyle = 'current_page';
              require_once __DIR__ . '/../templates/contact.php';
          }
      
      
          function listMovies()
          {
              $movieRepository = new \Mattsmithdev\MovieRepository();
              $movies = $movieRepository->findAll();
      
              $pageTitle = 'list';
              $listPageStyle = 'current_page';
              require_once __DIR__ . '/../templates/list.php';
          }
      
      
          function sitemap()
          {
              $pageTitle = 'sitemap';
              $sitemapPageStyle = 'current_page';
              require_once __DIR__ . '/../templates/sitemap.php';
          }
      }
    ```

- in the Front Controller `/public/index.php` do the following:

    - remove the `require_once` statement that used to read in the `/src/controllerFunctions.php` file (since all classes are available through the single `require_once` of the Composer-generated autoloader)
    
    - add a `use` statement so we can refer to the new class `MainController` with having to prefix it with namespace `Mattsmithdev`
    
    - create a new instance-object variable `$mainController` before the main `switch` statement
    
    - each case in the `switch` statement, now becomes an invocation of a public method of the `$mainController` object
    
    - so `/public/index,.php` now looks as follows:
    
        ```php
          require_once __DIR__ . '/../vendor/autoload.php';
          
          use Mattsmithdev\MainController;
          
          // get action GET parameter (if it exists)
          $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
          
          // based on value (if any) of 'action' decide which template to output
          $mainController = new MainController();
          switch ($action){
              case 'about':
                  $mainController->about();
                  break;
              case 'contact':
                  $mainController->contact();
                  break;
              case 'list':
                  $mainController->listMovies();
                  break;
              case 'sitemap':
                  $mainController->sitemap();
                  break;
              case 'index':
              default:
                  // default is home page ('index' action)
                  $mainController->home();
          }          
        ```