<?php

namespace App\Socialite\Providers;

use Laravel\Socialite\AbstractUser;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class SpotifyProvider extends AbstractProvider implements ProviderInterface {

    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase('https://accounts.spotify.com/authorize', $state);
    }

    protected function getTokenUrl(): string
    {
        return 'https://accounts.spotify.com/api/token';
    }

    public function getAccessToken($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => ['Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)],
            'body'    => $this->getTokenFields($code),
        ]);

        return $this->parseAccessToken($response->getBody());
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.spotify.com/v1/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function formatScopes(array $scopes, $scopeSeparator = ' '): string
    {
        return implode($scopeSeparator, $scopes);
    }

    protected function mapUserToObject(array $user): AbstractUser
    {
        return (new User)->setRaw($user)->map([
            'id'       => $user['id'],
            'nickname' => $user['display_name'],
            'name'     => $user['display_name'],
            'avatar'   => !empty($user['images']) ? $user['images'][0]['url'] : null,
        ]);
    }
}
