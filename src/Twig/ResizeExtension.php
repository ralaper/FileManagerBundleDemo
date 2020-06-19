<?php


namespace App\Twig;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Gregwar\Image\Image;
use Twig\TwigFunction;

class ResizeExtension extends AbstractExtension
{
    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;


    /**
     * ResizeExtension constructor.
     */
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('resize', [$this, 'resize']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('resize', [$this, 'resize']),
        ];
    }

    public function resize(string $image)
    {
        $publicDir = $this->parameterBag->get('kernel.project_dir') . '/' . $this->parameterBag->get('artgris_file_manager')['web_dir'];

        return Image::open($publicDir . $image)
            ->resize(22, 22)
            ->useFallback(false);
    }



}