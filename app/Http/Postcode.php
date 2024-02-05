<?php

namespace App\Http;

class Postcode
{
    protected ?string $postcode = null;
    protected mixed $result;

    public function __construct(?string $postcode = null)
    { 
        $this->postcode = $postcode;
    }

    public function setPostCode(?string $postcode = null): void
    { 
        $this->postcode = $postcode;
    }

    public function getPostCode(): string
    {
        return $this->postcode;
    }

    public function search(): array
    {
        $curl = curl_init();

      //$this->postcode = preg_replace( pattern:'/[^0-9]/', replacement:'', $this->postcode);

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://viacep.com.br/ws/{$this->postcode}/json/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $this->result = json_decode($response);
        
        return $this->toArray();
    }

    private function toArray(): array{
        return[
            'cep' => $this->result->cep,
            'logradouro' => $this->result->logradouro,
            'complemento' => $this->result->complemento,
            'bairro' => $this->result->bairro,
            'localidade' => $this->result->localidade,
            'uf' => $this->result->uf,
            'ibge' => $this->result->ibge,
            'gia' => $this->result->gia,
            'ddd' => $this->result->ddd,
            'siafi' => $this->result->siafi,
        ];
    }
}



