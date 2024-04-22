<?php

namespace App\Controller;

use App\Entity\LkpCategory;
use App\Entity\TblProduct;
use App\Entity\TblProductCategory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProductController extends AbstractController
{
    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse|Response
     */
    #[Route('/product/save', name: 'app_product_save')]
    public function save(Request $request, ValidatorInterface $validator): JsonResponse|Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('You are not authorized to perform this action');
        }
        $data = json_decode($request->getContent(), true);

        if (isset($data['product_id'])) {
            $product = $this->getDoctrine()->getRepository(TblProduct::class)->find($data['product_id']);
            $message = 'Product updated successfully';
        } else {
            $product = new TblProduct();
            $message = 'Product added successfully';
        }
        $product->setProductName($data['product_name'] ?? null);
        $product->setProductDescription($data['product_description'] ?? null);
        $product->setProductPrice($data['product_price'] ?? null);
        $product->setProductCode($data['product_code'] ?? null);
        $product->setProductImage('https://source.unsplash.com/random/400x300');

        $errors = $validator->validate($product);

        if (count($errors) > 0) {
            return new JsonResponse(['errors' => (string)$errors], Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);

        if (!isset($data['product_id']) &&
            isset($data['product_categories'])
        ) {
            if (!isset($data['product_id']) &&
                isset($data['product_categories'])
            ) {
                foreach ($data['product_categories'] as $value) {
                    $productCategory = new TblProductCategory();
                    $productCategory->setCategory($this->getDoctrine()
                        ->getRepository(LkpCategory::class)
                        ->find($value));
                    $productCategory->setProduct($product);
                    $em->persist($productCategory);
                }
            }
        }

        $em->flush();

        return new JsonResponse(['message' => $message], Response::HTTP_OK);
    }

    #[Route('/product/delete/{productId}', name: 'app_product_delete')]
    public function delete($productId): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('You are not authorized to perform this action');
        }
        $product = $this->getDoctrine()->getRepository(TblProduct::class)->find($productId);

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        $message = "Product deleted successfully $productId";

        return new JsonResponse(['message' => $message], Response::HTTP_OK);
    }
}
