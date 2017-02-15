<?php

namespace App\Http\Controllers;

use App\Disease;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $data = Disease::latest()->select(['date', 'agegroup', 'postcode', 'icd as disease_class'])->paginate(50);

        return [
            'meta' => [
                'count' => $data->total(),
                'next' => $data->nextPageUrl(),
                'previous' => $data->previousPageUrl()
            ],
            'data' => $this->transformCollection($data->all())
        ];
    }

    public function postcodes()
    {
        $data = Disease::distinct()
            ->select('postcode')
            ->get();

        return [
            'meta' => [
            ],
            'data' => $this->transformCollection($data->all(), true)
        ];
    }

    public function show($id)
    {
        $data = Disease::latest()
            ->where('postcode', $id)
            ->select(['date', 'agegroup', 'postcode', 'icd as disease_class'])
            ->paginate(50);

        return [
            'meta' => [
                'count' => $data->total(),
                'next' => $data->nextPageUrl(),
                'previous' => $data->previousPageUrl()
            ],
            'data' => $this->transformCollection($data->all())
        ];
    }

    private function transformCollection(array $items, $isPostcodes = false)
    {
        if($isPostcodes) {
            return array_map([$this, 'transformPostcodes'], $items);
        }
        return array_map([$this, 'transform'], $items);
    }

    private function transform($item)
    {
        $payload = [
            'date' => Carbon::createFromFormat('Y-m-d H:i:s', $item->date)->format('Y-m-d'),
            'postcode' => url('v1/'. $item->postcode),
            'agegroup' => $item->agegroup == 2 ? 'aikuinen' : 'alaikainen',
            'disease_class' => $this->icdToName($item->disease_class)
        ];

        return $payload;
    }

    private function transformPostcodes($item)
    {
        $payload = [
            $item->postcode => url('v1/'. $item->postcode),
        ];

        return $payload;
    }

    private function icdToName($disease_class)
    {
        $diseases = [
            '', // EI ole tautiluokkaa 0
            'Influenssa ja influenssan kaltaiset taudit',
            'Vatsataudit (tai ripuli- oksennustaudit)',
            'Vesirokko',
            'Streptokokin aiheuttamat nieluinfektiot ja tulirokko',
            'Aikuistyypin diabetes',
            'Klamydia'
        ];

        return $diseases[$disease_class];
    }

}
