<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;

class ApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Convert the resource to XML.
     *
     * @param  Request  $request
     * @return string
     */
    public function toXml($request)
    {
        $data = $this->toArray($request);
        $xml = ArrayToXml::convert($data);

        return $xml;
    }

    /**
     * Customize the response for the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $acceptHeader = $request->header('Accept');

        if (strpos($acceptHeader, 'application/xml') !== false) {
            $headers = [
                'Content-Type' => 'application/xml',
            ];

            return response($this->toXml($request), 200, $headers);
        }

        return parent::toResponse($request);
    }
}
