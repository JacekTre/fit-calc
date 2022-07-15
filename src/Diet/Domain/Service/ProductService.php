<?php

namespace App\Diet\Domain\Service;

use App\Diet\Application\Command\Product\CreateProduct;
use App\Diet\Application\Command\Product\UpdateProduct;
use App\Diet\Application\CommandBusInterface;
use App\Diet\Application\Query\Product\GetProductById;
use App\Diet\Application\Query\Product\GetProductByName;
use App\Diet\Application\Query\Product\GetProductsList;
use App\Diet\Application\Query\Product\ProductView;
use App\Diet\Application\QueryBusInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductService
{
    private CommandBusInterface $commandBus;

    private QueryBusInterface $queryBus;

    public function __construct(
        CommandBusInterface $commandBus,
        QueryBusInterface $queryBus
    ) {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function createProduct(Request $request): ProductView
    {
        //todo: product validation

        $command = new CreateProduct(
            (string) $request->get('name'),
            intval($request->get('kcal')),
            floatval($request->get('proteins')),
            floatval($request->get('fat')),
            floatval($request->get('carbs')),
        );

        $this->commandBus->dispatch($command);

        $query = new GetProductByName(
            (string) $request->get('name')
        );

        return $this->queryBus->dispatch($query);
    }

    public function getProductByName(string $name): ProductView
    {
        $query = new GetProductByName($name);

        return $this->queryBus->dispatch($query);
    }

    public function getProductById(string $id): ProductView
    {
        $query = new GetProductById($id);

        return $this->queryBus->dispatch($query);
    }

    public function update(Request $request): ProductView
    {
        $command = new UpdateProduct(
            (string) $request->get('id'),
            (string) $request->get('name'),
            intval($request->get('kcal')),
            floatval($request->get('proteins')),
            floatval($request->get('fat')),
            floatval($request->get('carbs')),
        );

        $this->commandBus->dispatch($command);

        $query = new GetProductById(
            (string) $request->get('id')
        );

        return $this->queryBus->dispatch($query);
    }

    public function getList(int $pageSize, int $page): array
    {
        //todo: changing temporary page and page size
        $pageSize = 20;
        $page = 1;

        $query = new GetProductsList(
            ($pageSize === 0) ? 1: $pageSize,
            ($page === 0) ? 1 : $page
            );

        return $this->queryBus->dispatch($query);
    }
}