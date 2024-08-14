<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VehicleModelRequest;
use App\Http\Resources\VehicleModelResource;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class VehicleModelController extends Controller
{
    public function index()
    {
        return VehicleModelResource::collection(VehicleModel::all());
    }

    public function store(VehicleModelRequest $request)
    {
        $vehicle_model = VehicleModel::create($request->validated());

        return new VehicleModelResource($vehicle_model);
    }

    public function show(VehicleModel $vehicle_model)
    {
        return new VehicleModelResource($vehicle_model);
    }

    public function update(VehicleModelRequest $request, VehicleModel $vehicle_model)
    {
        $vehicle_model->update($request->validated());

        return new VehicleModelResource($vehicle_model);
    }

    public function destroy(vehicle_model $vehicle_model)
    {
        $vehicle_model->delete();

        return response()->noContent();
    }
    public static function vehicleTag(Request $request)
    {


        // Acessar o array 'data' enviado na solicitação
        $tags = $request->input('data');

        // // Verificar se os dados foram recebidos corretamente
        // // \Log::info('Tags recebidas:', $tags);

        // // Exemplo de como você pode processar esses dados
        foreach ($tags as $tag) {
            // Acessar o valor de 'tag'
            $tagValue = $tag['tag'];
            // Processar o valor conforme necessário
            // \Log::info('Tag:', $tagValue);
        }

        $tagsData = $request->input('data', []);

        $products = DB::select("
            SELECT p.ID, p.post_title, pm.meta_key, pm.meta_value
            FROM wp_posts p
            LEFT JOIN wp_postmeta pm ON p.ID = pm.post_id
            WHERE p.post_type = 'product'
            AND p.post_status = 'publish'
            AND pm.meta_key IN ('_price')
        ");

        $products = DB::select("
            SELECT p.ID, p.post_title, pm.meta_value as price, GROUP_CONCAT(t.name SEPARATOR ', ') as tags
            FROM wp_posts p
            LEFT JOIN wp_postmeta pm ON p.ID = pm.post_id AND pm.meta_key = '_price'
            LEFT JOIN wp_term_relationships tr ON p.ID = tr.object_id
            LEFT JOIN wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy = 'product_tag'
            LEFT JOIN wp_terms t ON tt.term_id = t.term_id
            WHERE p.post_type = 'product'
            AND p.post_status = 'publish'
            GROUP BY p.ID, p.post_title, pm.meta_value
        ");

         // Transforma os resultados em uma coleção para manipulação fácil
    $products = collect($products);

    // Mapeia os produtos e calcula os matches para cada um
    $results = $products->map(function ($item) use ($tagsData) {
        // Quebra a string de tags em um array
        $productTags = explode(', ', $item->tags);

        // Contador de matches
        $matches = 0;

        // Verifica quantas tags coincidem
        foreach ($tagsData as $tag) {
            if (in_array($tag, $productTags)) {
                $matches++;
            }
        }

        // Retorna o produto com o número de matches
        return [
            'ID' => $item->ID,
            'post_title' => $item->post_title,
            'price' => $item->price,
            'tags' => $item->tags,
            'matches' => $matches,
        ];
    });

    // Ordena os resultados por número de matches em ordem decrescente
    $sortedResults = $results->sortByDesc('matches')->values();

    // Retorna o resultado como JSON
    return response()->json($sortedResults);

        return response()->json($products);
        // return response()->json($tagsData);
        // Extrai apenas os valores da propriedade 'tag'
        $tagsToSearch = array_column($tagsData, 'tag');

        // Processa os registros da tabela
        $results = VehicleModel::query()
            ->select('modelo', 'tag1', 'tag2', 'tag3', 'tag4')
            ->get()
            ->map(function ($item) use ($tagsToSearch) {
                $matches = 0;

                foreach ($tagsToSearch as $tag) {
                    if (in_array($tag, [$item->tag1, $item->tag2, $item->tag3, $item->tag4])) {
                        $matches++;
                    }
                }

                return [
                    'modelo' => $item->modelo,
                    'matches' => $matches,
                ];
            })
            ->sortByDesc('matches')
            ->values();

        return response()->json($results);
        // Retornar uma resposta JSON
        // return response()->json([
        //     'message' => 'Dados recebidos com sucesso',
        //     'data' => $tags
        // ]);

    }
}