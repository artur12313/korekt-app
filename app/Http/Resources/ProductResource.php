<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->nazwa,
            'dostawca' => $this->dostawca,
            'jednostka' => $this->jednostka,
            'cena_zakupu_netto' => $this->cena_zakupu_netto,
            'updated_at' => date_format($this->updated_at, "d-m-Y"),
            'category' => $this->category ? $this->category->name : null
        ];
    }
}