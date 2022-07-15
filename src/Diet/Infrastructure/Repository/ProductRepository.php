<?php

namespace App\Diet\Infrastructure\Repository;

use App\Diet\Application\Query\Product\ProductView;
use App\Diet\Domain\Model\Product;
use App\Diet\Domain\Repository\AbstractRepository;
use App\Diet\Domain\Repository\ProductRepositoryInterface;
use App\Diet\Infrastructure\Factory\ProductViewFactory;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function remove(Product $product): void
    {
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    public function getById(string $id): ProductView
    {
        $sql = "select * from public.product where uuid = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindValue('id', $id);
        $query->execute();

        $data = $query->fetch($this->pdo::FETCH_ASSOC);
        if (is_null($data) || empty($data)) {
            throw new \Exception('Product does not exist!');
        }

        return ProductViewFactory::create($data);
    }

    public function getByIdORM(string $id): Product
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getByNameORM(string $name): ?Product
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->where('p.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getByName(string $name): ProductView
    {
        $sql = "select * from public.product where name = :name";
        $query = $this->pdo->prepare($sql);
        $query->bindValue('name', $name);
        $query->execute();

        $data = $query->fetch($this->pdo::FETCH_ASSOC);
        if (is_null($data) || empty($data)) {
            throw new \Exception('Product does not exist!');
        }

        return ProductViewFactory::create($data);
    }

    public function getList(int $pageSize, int $page): array
    {
        $sql = "select * from public.product  limit :limit offset :offset";
        $query = $this->pdo->prepare($sql);
        $query->bindValue('limit', $pageSize);
        $query->bindValue('offset', $pageSize * ($page - 1) );
        $query->execute();

        $data = $query->fetchAll($this->pdo::FETCH_ASSOC);
        if (is_null($data) || empty($data)) {
            throw new \Exception('List is empty');
        }

        $result = [];
        foreach ($data as $datum) {
            $result[] = ProductViewFactory::create($datum);
        }

        return $result;
    }
}