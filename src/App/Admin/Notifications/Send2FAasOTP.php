<?php

namespace App\Admin\Notifications;

use Domain\Users\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Laravel\Fortify\TwoFactorAuthenticatable;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use Support\Authentication\Actions\GenerateOtpCodeForSecretAction;

class Send2FAasOTP extends Notification
{
    /** @return array<int, string> */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws SecretKeyTooShortException
     * @throws InvalidCharactersException
     */
    public function toMail(User $notifiable): MailMessage
    {
        if (!in_array(TwoFactorAuthenticatable::class, class_uses_recursive($notifiable))) {
            throw new \InvalidArgumentException('Send2FAasOTP expects an 2FA Object');
        }

        $code = app(GenerateOtpCodeForSecretAction::class)->execute($notifiable);

        return (new MailMessage())
            ->subject(__('notifications.2fa.subject'))
            ->greeting(__('notifications.2fa.greeting'))
            ->line(new HtmlString('<h2>'. $code .'</h2>'))
            ->line(__('notifications.2fa.instructions'))
            ->line(__('notifications.2fa.warning'))
            ->salutation(new HtmlString(__('notifications.2fa.salutation')));
    }
}
