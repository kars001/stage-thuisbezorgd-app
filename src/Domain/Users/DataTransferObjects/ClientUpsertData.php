<?php

namespace Domain\Users\DataTransferObjects;

use Domain\Users\Models\User;
use Illuminate\Support\Str;
use Support\Authentication\Enums\OAuthConnectionTypesEnum;

class ClientUpsertData
{
    /**
     * @param string $name
     * @param string|null $type
     * @param bool|null $confidential
     * @param array<string>|null $redirect_uris
     * @param string|null $owner_id
     * @param string|null $secret
     * @param bool $revoked
     */
    public function __construct(
        public readonly string  $name,
        public readonly ?string $type = null,
        public readonly ?bool   $confidential = false,
        public readonly ?array  $redirect_uris = [],
        public readonly ?string $owner_id = null,
        public readonly ?string $secret = null,
        public readonly bool    $revoked = false
    )
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'redirect_uris' => $this->redirect_uris,
            'revoked' => $this->revoked,
        ];

        // Set grant types based on the type
        if ($this->type) {
            $data['grant_types'] = [$this->type, 'refresh_token'];
        }

        // Set owner_id if provided
        if ($this->owner_id) {
            $data['owner_id'] = $this->owner_id;
            $data['owner_type'] = User::class;
        } else {
            $data['owner_id'] = null;
            $data['owner_type'] = null;
        }

        // Handle secret based on type and confidentiality
        if ($this->type === OAuthConnectionTypesEnum::CLIENT_CREDENTIALS->value || $this->confidential) {
            $data['secret'] = $this->secret ?? Str::random(40);
        } else {
            $data['secret'] = null;
        }

        return $data;
    }
}
