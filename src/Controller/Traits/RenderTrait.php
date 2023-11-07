<?php
/**
 * Xzit Giggle
 *
 * This file `RenderTrait.php` is part of the `Xzit Giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 05.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Traits;

use League\Plates\Engine;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;

trait RenderTrait
{
    use ContainerTrait,
        ResponseTrait;

    /** @var Engine $engine */
    private Engine $engine;

    /**
     * @param Engine $engine
     * @return void
     */
    public function setRenderEngine(Engine $engine): void
    {
        $this->engine = $engine;
    }

    /**
     * @return Engine
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getRenderEngine(): Engine
    {
        if (!isset($this->engine)) {
            if ($this->getContainer()->has(Engine::class)) {
                $this->engine = $this->getContainer()->get(Engine::class);
            } else {
                $this->engine = new Engine(ROOT . '/src/Templates');
                $this->engine->addFolder('layouts', ROOT . '/src/Templates/layout');
            }
        }

        return $this->engine;
    }

    /**
     * @param string $template
     * @param array|null $data
     * @param ResponseInterface|null $response
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function render(
        string             $template,
        ?array             $data = [],
        ?ResponseInterface $response = null): ResponseInterface
    {

        if ($response === null) {
            $response = $this->getResponse();
        }

        $response->getBody()->write(
            $this->getRenderEngine()->render(
                $template,
                $data
            )
        );

        return $response;
    }

}