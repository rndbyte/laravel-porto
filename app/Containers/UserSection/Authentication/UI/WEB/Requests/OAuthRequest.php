<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authentication\UI\WEB\Requests;

use App\Ship\Abstracts\Requests\ApiRequest as AbstractRequest;

/**
 * @summary User registration or authentication with Social service
 * @description
 * <p>The API returns a string for OAuth identification, you need to open it in a new browser window and go through the procedure for identifying the Twitch user</p>
 *
 * <p>The Twitch account is searched for and the associated user is authenticated.
 * If the account is not found, a new user is registered.</p>
 *
 * <p>After successful authentication, you go to the <a href="/auth/finish" target="_blank">settings page</a>
 * if a new user is created or <a href="/" target="_blank">dashboard page</a> if the user existed previously.
 * HTTP GET parameter access_token will contain the value of the generated token key</p>
 */
class OAuthRequest extends AbstractRequest
{
}
