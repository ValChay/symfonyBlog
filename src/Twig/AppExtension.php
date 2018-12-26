<?php

namespace App\Twig;

use App\Utils\Good;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $good;

    /**
     * AppExtension constructor.
     */
    public function __construct(Good $good)
    {
        $this->good = $good;
    }

    public function getFilters(): array
    {

    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('welldone', function(){
            return $this->good->welldone();
    }),
        ];
    }


}
