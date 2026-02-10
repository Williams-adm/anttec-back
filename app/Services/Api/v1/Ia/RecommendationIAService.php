<?php

namespace App\Services\Api\v1\Ia;

use App\Contracts\Api\v1\Ia\ProductIaInterface;
use App\Http\Resources\Api\v1\Ia\ProductIaResource;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecommendationIAService
{
    private string $aiApiUrl;

    public function __construct(
        private ProductIaInterface $repository
    ) {
        // URL de tu API Python (desde .env)
        $this->aiApiUrl = config('integrations.ia.url_ia', 'http://localhost:8001');
    }

    /**
     * Envía una consulta al sistema de IA para obtener recomendaciones.
     *
     * @param string $query Consulta del usuario ("necesito un mouse gaming")
     * @param string|null $conversationId ID de conversación (para seguimiento)
     * @return array Respuesta de la IA
     */
    public function recommend(string $query, ?string $conversationId = null): array
    {
        try {
            $response = Http::timeout(160)
                ->post("{$this->aiApiUrl}/recommend", [
                    'query' => $query,
                    'conversation_id' => $conversationId,
                ]);

            if ($response->failed()) {
                Log::error('AI API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                throw new Exception('Error al comunicarse con el sistema de IA');
            }

            return $response->json();
        } catch (Exception $e) {
            Log::error('AI Recommendation Error', [
                'message' => $e->getMessage(),
                'query' => $query
            ]);

            throw $e;
        }
    }

    /**
     * Sincroniza el catálogo completo con la IA.
     *
     * @return array Resultado de la sincronización
     */
    public function syncCatalog(): array
    {
        try {
            // 1. Obtener todos los productos
            $products = $this->repository->getAllForAI();

            // 2. Transformar a formato AI
            $productsData = ProductIaResource::collection($products)->resolve();

            Log::info('Sincronizando catálogo con IA', [
                'total_products' => count($productsData)
            ]);

            // 3. Enviar a Python
            $response = Http::timeout(240) // 2 minutos para catálogos grandes
                ->post("{$this->aiApiUrl}/sync-catalog", [
                    'products' => $productsData
                ]);

            if ($response->failed()) {
                throw new Exception('Error al sincronizar catálogo: ' . $response->body());
            }

            $result = $response->json();

            Log::info('Catálogo sincronizado exitosamente', $result);

            return $result;
        } catch (Exception $e) {
            Log::error('Catalog Sync Error', [
                'message' => $e->getMessage()
            ]);

            throw $e;
        }
    }

    /**
     * Sincroniza un producto específico con la IA.
     *
     * Útil cuando se crea/edita un solo producto.
     */
    public function syncProduct(int $productId): void
    {
        try {
            // En lugar de sincronizar solo 1, re-sincronizamos todo
            // Es más simple y asegura consistencia
            $this->syncCatalog();
        } catch (Exception $e) {
            Log::error('Product Sync Error', [
                'product_id' => $productId,
                'message' => $e->getMessage()
            ]);

            // No lanzamos excepción para no bloquear la creación/edición del producto
            // Solo logueamos el error
        }
    }
}
