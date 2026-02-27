<?php

namespace Domain\Restaurants\DataTransferObjects;

use Domain\Restaurants\Enums\RestaurantStatusEnum;

class RestaurantUpsertData
{
    public function __construct(
        public string $naam,
        public string $beschrijving,
        public RestaurantStatusEnum $status,
        /** @var array<mixed> */
        public array $bezorggebied,
        /** @var array<mixed> */
        public array $open_en_sluit_tijden,
        public ?string $adres = null,
        public ?float $minimaal_bestelbedrag = null,
        public ?float $bezorgkosten = null,
        public ?string $logo_url = null,
        public ?string $header_url = null,
    ){}

    /**
     * @return array{
     *   bezorggebied: array<string, array{postcode: string}>,
     *   open_en_sluit_tijden: array<string, array<string, string>>,
     * }
     */
    public function toArray(): array
    {
        return [
            'naam' => $this->naam,
            'beschrijving' => $this->beschrijving,
            'adres' => $this->adres,
            'bezorggebied' => $this->bezorggebied,
            'open_en_sluit_tijden' => $this->open_en_sluit_tijden,
            'minimaal_bestelbedrag' => $this->minimaal_bestelbedrag,
            'bezorgkosten' => $this->bezorgkosten,
            'status' => $this->status->value,
            'logo_url' => $this->logo_url,
            'header_url' => $this->header_url,
        ];
    }
}
