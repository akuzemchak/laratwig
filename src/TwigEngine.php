<?php

namespace Kuz\LaraTwig;

use Illuminate\View\Engines\EngineInterface;

class TwigEngine implements EngineInterface
{
    /**
     * Twig environment
     *
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Constructor
     *
     * @param \Twig_Environment $twig
     * @return void
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * {@inheritdoc}
     */
    public function get($path, array $data = [])
    {
        return $this->twig->render($path, $data);
    }
}
