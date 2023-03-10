<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use function Symfony\Component\String\u;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable, Notifiable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to create the reset password URL.
     *
     * @var \Closure|null
     */
    public static $createUrlCallback;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $user = User::where('email', $notifiable->getEmailForPasswordReset())->get('name');

        return $this->buildMailMessage($this->resetUrl($notifiable), $user[0]->name);
    }

    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url, $name)
    {
        return (new MailMessage)
            ->from('LibraryManage@mail.com', 'Library Manage')
            ->subject('Th??ng b??o ?????t l???i m???t kh???u')
            ->greeting('Xin ch??o ' . $name . '!')
            ->line('B???n nh???n ???????c email n??y v?? ch??ng t??i ???? nh???n ???????c y??u c???u ?????t l???i m???t kh???u cho t??i kho???n c???a b???n.')
            ->action('Link ?????t l???i m???t kh???u', $url)
            ->line(Lang::get('Link ?????t l???i m???t kh???u c?? hi???u l???c trong :count ph??t.', ['count' => config('auth.passwords.users.expire')]))
            ->line('N???u b???n kh??ng y??u c???u ?????t l???i m???t kh???u, vui l??ng b??? qua email n??y v?? kh??ng c???n th???c hi???n th??m h??nh ?????ng n??o.')
            ->line('C???m ??n ???? s??? d???ng d???ch v??? c???a ch??ng t??i.');
    }

    /**
     * Get the reset URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }


    /**
     * Save into 'data' field in 'notifications' table, convert to format json
     * stored in 'data' field not show UTF-8 but convert json to array by json_decode($json) can show UTF-8
     *
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'subject' => 'Th??ng b??o ?????t l???i m???t kh???u',
            'token'   => $this->token,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
