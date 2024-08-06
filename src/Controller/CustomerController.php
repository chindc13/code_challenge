<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;

class CustomerController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/customers", name="get_customers", methods={"GET"})
     */
    public function getCustomers(): Response
    {
        $customers = $this->entityManager
            ->getRepository(Customer::class)
            ->findAll();

        $data = [];
        foreach ($customers as $customer) {
            $data[] = [
                'fullName' => $customer->getFirstName() . ' ' . $customer->getLastName(),
                'email' => $customer->getEmail(),
                'username' => $customer->getUsername(),
                'country' => $customer->getCountry(),
                'gender' => $customer->getGender(),
                'city' => $customer->getCity(),
                'phone' => $customer->getPhone(),
            ];
        }

        return $this->json($data);
    }

    /**
     * @Route("/customers/{id}", name="get_customer", methods={"GET"})
     */
    public function getCustomer(int $id): Response
    {
        $customer = $this->entityManager
            ->getRepository(Customer::class)
            ->find($id);

        if (!$customer) {
            throw $this->createNotFoundException('No customer found for id ' . $id);
        }

        $data = [
            'fullName' => $customer->getFirstName() . ' ' . $customer->getLastName(),
            'email' => $customer->getEmail(),
            'username' => $customer->getUsername(),
            'country' => $customer->getCountry(),
            'gender' => $customer->getGender(),
            'city' => $customer->getCity(),
            'phone' => $customer->getPhone(),
        ];

        return $this->json($data);
    }
}