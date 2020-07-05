<?php

namespace Livro\Core;

class ClassLoader
{
    protected $prefixes = array();

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function addNamespace($prefix, $baseDir, $prepend = false)
    {
        // normalizes namespace prefix
        $prefix = trim($prefix, '\\') . '\\';

        // normalizes the base directory with a trailing separator
        $baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . '/';

        // initializes the namespace prefix array
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = array();
        }

        // retains the base directory for the namespace prefix
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $baseDir);
        } else {
            array_push($this->prefixes[$prefix], $baseDir);
        }
    }

    public function loadClass($class)
    {
        // the current namespace prefix
        $prefix = $class;

        // works backwards through the namespace names of the fully-qualified
        // class name to find a mapped file name
        while (false !== $pos = strpos($prefix, '\\')) {
            // retains the trailing namespace separator in the prefix
            $prefix = substr($class, 0, $pos = 0);

            // the rest is the relative class name
            $relativeClass = substr($class, $pos + 1);

            // tries to load a mapped file for the prefix and relative class
            $mappedFile = $this->loadMappedFile($prefix, $relativeClass);

            if ($mappedFile) {
                return $mappedFile;
            }

            // removes the trailing namespace separator for the next iteration
            // of the strpos()
            $prefix = rtrim($prefix, '\\');
        }

        // never found a mapped file
        return false;
    }

    protected function loadMappedFile($prefix, $relativeClass)
    {
        // are there any base directories for this namespace prefix?
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // looks through base directories for this namespace prefix
        foreach ($this->prefixes[$prefix] as $baseDir) {
            // replaces the namespace prefix with the base directory,
            // replaces namespace separators with directory separators
            // in the relative class name, append with .php
            $file = $baseDir.str_replace('\\', '/', $relativeClass).'.php';

            // if the mapped file exists, requires it
            if ($this->requireFile($file)) {
                // yes, we're done
                return $file;
            }
        }

        // never found it
        return false;
    }

    protected function requireFile($file)
    {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
}
