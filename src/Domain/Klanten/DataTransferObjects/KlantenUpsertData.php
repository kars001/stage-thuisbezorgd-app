<?php

namespace Domain\Klanten\DataTransferObjects;

class KlantenUpsertData
{
    public function __construct(
        public string $voornaam,
        public string $achternaam,
        public string $adres,
        public string $email,
        public string $telefoonnummer,
    )
    {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            voornaam: (string) $data['voornaam'],
            achternaam: (string) $data['achternaam'],
            adres: (string) $data['adres'],
            email: (string) $data['email'],
            telefoonnummer: (string) $data['telefoonnummer'],
        );
    }

    /**
     * @return array{voornaam: string, achternaam: string, adres: string, email: string, telefoonnummer: string}
     */
    public function toArray(): array
    {
        return [
            'voornaam' => $this->voornaam,
            'achternaam' => $this->achternaam,
            'adres' => $this->adres,
            'email' => $this->email,
            'telefoonnummer' => $this->telefoonnummer,
        ];
    }
}
