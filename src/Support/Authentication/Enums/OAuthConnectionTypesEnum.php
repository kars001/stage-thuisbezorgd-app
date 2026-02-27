<?php

namespace Support\Authentication\Enums;

enum OAuthConnectionTypesEnum: string
{
    case CLIENT_CREDENTIALS = 'client_credentials';

    case AUTHORIZATION_CODE = 'authorization_code';

    /**
     * @return array<string, string>
     */
    public static function getCasesForSelect(): array
    {
        return [
            OAuthConnectionTypesEnum::CLIENT_CREDENTIALS->value => 'Client Credentials',
            OAuthConnectionTypesEnum::AUTHORIZATION_CODE->value => 'Authorization Code',
        ];
    }

    public static function getHelperTextForKey(string $key): string
    {
        return match (self::from($key)) {
            self::CLIENT_CREDENTIALS => "Client credentials are used to connect two server applications. The other party only needs the Client ID and Client Secret to obtain an Access Token",
            self::AUTHORIZATION_CODE => "Authorization codes are used to connect when secrets cannot be kept. Using this flow an user will be redirected to this portal to login and then back to te original application."
        };
    }
}
