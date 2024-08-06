<?php
namespace App\Service;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CustomerImporter
{
    private $httpClient;
    private $entityManager;

    public function __construct(HttpClientInterface $httpClient, EntityManagerInterface $entityManager)
    {
        $this->httpClient = $httpClient;
        $this->entityManager = $entityManager;
    }

    public function importCustomers(int $count = 100)
    {
        $response = $this->httpClient->request('GET', 'https://randomuser.me/api?nat=au', [
            'query' => [
                'results' => $count,
                'nat' => 'AU'
            ]
        ]);

        $data = $response->toArray();

        foreach ($data['results'] as $userData) {
            $customer = $this->entityManager->getRepository(Customer::class)->findOneBy(['email' => $userData['email']]);
            if (!$customer) {
                $customer = new Customer();
            }

            $customer->setFirstName($userData['name']['first']);
            $customer->setLastName($userData['name']['last']);
            $customer->setEmail($userData['email']);
            $customer->setUsername($userData['login']['username']);
            $customer->setPassword(md5($userData['login']['password']));
            $customer->setGender($userData['gender']);
            $customer->setCountry($userData['location']['country']);
            $customer->setCity($userData['location']['city']);
            $customer->setPhone($userData['phone']);

            $this->entityManager->persist($customer);
        }

        $this->entityManager->flush();
    }
}