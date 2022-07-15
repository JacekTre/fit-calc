<?php

namespace App\Controller;

use App\Diet\Application\CommandBusInterface;
use App\Diet\Domain\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductService $productService;

    public function __construct(
        ProductService $productService
    ) {
        $this->productService = $productService;
    }

    /**
     * @Route("/product", name="product_index")
     */
    public function index(Request $request): Response
    {
        $pageSize = intval($request->get('pageSize') ?? 0);
        $page = intval($request->get('page') ?? 0);

        $products = $this->productService->getList($pageSize, $page);

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/add", name="product_add")
     */
    public function add(): Response
    {
        return $this->render('product/add.html.twig');
    }

    /**
     * @Route("/product/save", name="product_save")
     */
    public function save(Request $request): Response
    {
        try {
            $product = $this->productService->createProduct($request);
        } catch (\Exception $exception) {
            return $this->redirectToRoute('error_page', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @Route("/product/show/{id}", name="product_show")
     */
    public function show(string $id): Response
    {
        try {
            $productView = $this->productService->getProductById($id);

            return $this->render('product/show.html.twig', [
                'product' => $productView
            ]);
        } catch (\Exception $exception) {
            return $this->redirectToRoute('error_page', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @Route("/product/edit/{id}", name="product_edit")
     */
    public function edit(string $id): Response
    {
        try {
            $productView = $this->productService->getProductById($id);

            return $this->render('product/edit.html.twig', [
                'product' => $productView
            ]);
        } catch (\Exception $exception) {
            return $this->redirectToRoute('error_page', [
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @Route("/product/saveExist", name="product_save_exist")
     */
    public function saveExist(Request $request): Response
    {
        try {
            $productView = $this->productService->update($request);

            return $this->redirectToRoute('product_show', [
                'id' => $productView->getId()
            ]);
        } catch (\Exception $exception) {
            return $this->redirectToRoute('error_page', [
                'message' => $exception->getMessage()
            ]);
        }
    }
}
