<?php
// travelNepal Simple Router

class Router {
    private $routes = [];
    
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }
    
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }
    
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Handle XAMPP subfolder
        $basePath = '/travelNepal';
        if (strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
        }
        
        if (empty($path)) {
            $path = '/';
        }
        
        // Remove trailing slash except for root
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }
        
        // Normalize duplicate slashes
        
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];
            if (is_callable($callback)) {
                return call_user_func($callback);
            }
        }
        
        // Check for dynamic routes (blog posts)
        foreach ($this->routes[$method] ?? [] as $route => $callback) {
            if (strpos($route, '{') !== false) {
                $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
                $pattern = '#^' . $pattern . '$#';
                
                if (preg_match($pattern, $path, $matches)) {
                    array_shift($matches); // Remove full match
                    return call_user_func_array($callback, $matches);
                }
            }
        }
        
        // 404 Not Found
        http_response_code(404);
        include 'templates/404.php';
    }
}
?>