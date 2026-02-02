<?php

namespace App\Services\Api\v1\Shop;

use App\Contracts\Api\v1\Shop\CustomerSInterface;
use App\Services\Api\v1\integrations\SearchDNIService;

class CustomerSService
{
    public function __construct(
        protected CustomerSInterface $repository,
        protected SearchDNIService $service
    ) {}

    public function getBYCustomerDNI(string $dni)
    {
        $customer = $this->repository->getBYCustomerDNI($dni);
        if ($customer) {
            return [
                'status'  => true,
                'message' => 'Cliente encontrado en base de datos',
                'data'    => [
                    'name'            => $customer->name,
                    'last_name'       => $customer->last_name,
                    'document_number' => $dni,
                ],
            ];
        }

        // 2️⃣ Consultar RENIEC
        $reniecData = $this->service->searchDNI($dni);

        if ($reniecData) {
            return [
                'status'   => true,
                'message' => 'Datos obtenidos desde RENIEC',
                'data'    => $reniecData,
            ];
        }

        // 3️⃣ No encontrado
        return [
            'status'   => false,
            'message' => 'DNI no encontrado',
        ];
    }
}
