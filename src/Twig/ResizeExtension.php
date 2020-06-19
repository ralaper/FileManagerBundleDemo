<?php


namespace App\Twig;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
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
     * @var RequestStack
     */
    private $requestStack;


    /**
     * ResizeExtension constructor.
     */
    public function __construct(ParameterBagInterface $parameterBag, RequestStack $requestStack)
    {
        $this->parameterBag = $parameterBag;
        $this->requestStack = $requestStack;
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

        $size = $this->requestStack->getMasterRequest()->get('view') === 'thumbnail' ? 100 : 22;

        return Image::open($publicDir . $image)
            ->resize($size, $size)
            ->useFallback(false);
    }



}