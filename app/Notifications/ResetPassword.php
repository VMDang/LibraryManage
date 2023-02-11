<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use function Symfony\Component\String\u;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

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
            ->subject('Thông báo đặt lại mật khẩu')
            ->greeting('Xin chào ' . $name . '!')
            ->line('Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.')
            ->action('Link Đặt lại mật khẩu', $url)
            ->line(Lang::get('Link đặt lại mật khẩu có hiệu lực trong :count phút.', ['count' => config('auth.passwords.users.expire')]))
            ->line('Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này và không cần thực hiện thêm hành động nào.')
            ->line('Cảm ơn đã sử dụng dịch vụ của chúng tôi.');
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
        $user = User::where('email', $notifiable->getEmailForPasswordReset())->get('name');

        return [
            'subject' => 'Thông báo đặt lại mật khẩu',
            'name' => $user[0]->name,
            'email' => $notifiable->getEmailForPasswordReset(),
            'url'   => $this->resetUrl($notifiable),
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
