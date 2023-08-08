<?php

namespace App\Config;

class DataConfig
{
    /**
     * @var string
     */
    private string $filePath;
    /**
     * @var string
     */
    private string $basePath;
    /**
     * @var string
     */
    private string $path;

    /**
     * DataConfig constructor.
     * @param string $basePath
     * @param string $filePath
     */
    public function __construct(
        string $basePath,
        string $filePath
    )
    {
        $this->path = $basePath . $filePath;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}