<?php

if (! function_exists('src_path')) {
    function src_path(string $path = ''): string
    {
        //$this->joinPaths($this->appPath ?: $this->basePath('app'), $path)
        return app()->joinPaths(app()->basePath('src'), $path);
    }
}
