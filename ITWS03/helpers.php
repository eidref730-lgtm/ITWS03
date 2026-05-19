<?php

/**
 * Get base path of the project
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Load a view template from root views/ directory
 * 
 * @param string $name
 * @param array $data
 * @return void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/Views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View '{$name}' not found.";
        echo "<br>";
        echo "Looking for: " . $viewPath;
    }
}

/**
 * Load a partial template from root App/Views/Partials/ directory
 * 
 * @param string $name
 * @param array $data
 * @return void
 */
function loadPartial($name, $data = [])
{
    $partialPath = basePath("App/Views/Partials/{$name}.php");

    if (file_exists($partialPath)) {
        extract($data);
        require $partialPath;
    } else {
        echo "Partial '{$name}' not found.";
        echo "<br>";
        echo "Looking for: " . $partialPath;
    }
}

/**
 * Inspect value (var_dump wrapper)
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspect value and terminate execution
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

/**
 * Generate a dynamic URL relative to the base folder
 * 
 * @param string $path
 * @return string
 */
function url($path = '')
{
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    // Replace any backslashes (Windows) with forward slashes
    $basePath = str_replace('\\', '/', $basePath);
    $url = $basePath . '/' . ltrim($path, '/');
    return $url === '//' ? '/' : $url;
}

/**
 * Format salary to Philippine Peso currency format
 * 
 * @param mixed $salary
 * @return string
 */
function formatSalary($salary)
{
    if ($salary === null || $salary === '') {
        return 'Not specified';
    }

    // Strip out all non-numeric characters except decimals to see if it is a number
    $cleanSalary = preg_replace('/[^\d.]/', '', $salary);

    if (is_numeric($cleanSalary) && $cleanSalary !== '') {
        return '₱' . number_format((float) $cleanSalary);
    }

    // If it's something like "Negotiable", return it as is
    return $salary;
}

/**
 * Sanitize HTML data
 * 
 * @param string $dirty
 * @return string
 */
function sanitize($dirty) {
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given URL
 * 
 * @param string $url
 * @return void
 */
function redirect($url) {
    header("Location: {$url}");
    exit;
}