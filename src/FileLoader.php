<?php

namespace Kuz\LaraTwig;

class FileLoader extends \Twig_Loader_Filesystem
{
    /**
     * File extension for Twig templates
     *
     * @var string
     */
    protected $extension;

    /**
     * Constructor
     *
     * @param string|array $paths
     * @param string $extension
     * @return void
     */
    public function __construct($paths = [], $extension = 'twig')
    {
        parent::__construct($paths);

        $this->extension = $extension;
    }

    /**
     * {@inheritdoc}
     */
    protected function findTemplate($name)
    {
        $real_name = realpath($name);

        // Make the filename relative to the template directory
        foreach ($this->getPaths() as $path) {
            $real_path = realpath($path);

            if (strpos($real_name, $real_path) === 0) {
                $name = ltrim(str_replace($real_path, '', $real_name), '/');
                break;
            }
        }

        // Ensure that the file extension is always present
        if (!preg_match("/\.{$this->extension}$/", $name)) {
            $name .= ".{$this->extension}";
        }

        return parent::findTemplate($name);
    }
}
