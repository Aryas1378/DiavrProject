<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
//        \Illuminate\Support\Facades\DB::listen(function (\Illuminate\Database\Events\QueryExecuted $sql) {
//            dump(vsprintf(str_replace('?', '%s', $sql->sql), $sql->bindings));
//        });

        $ads = Ad::query()
            ->where(function (Builder $query) use ($request) {
                $query
                    ->where('title', 'like', '%' . $request->get('search_title') . '%')
                    ->orWhere('description', 'like', '%' . $request->get('search_title') . '%')
                    ->orWhereHas('category', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->get('search_title') . '%');
                    });
            });

        if ($request->has('attributes')) {
            foreach ($request->get('attributes') as $attribute) {
                $ads->whereHas('attributes', function (Builder $query) use ($request, $attribute) {
                    $query->where(function (Builder $q) use ($request, $attribute) {
                        $q->where('attribute_id', $attribute['attribute_id'])
                            ->where('value', $attribute['attribute_value']);
                    });
                });
            }
        }

        $ads->whereHas('status', function (Builder $query){
            $query->where('name', '=', 'accepted');
        });

        return $this->success(AdResource::collection($ads
            ->with('attributes', 'city', 'category', 'status')
            ->get()));

    }
}
