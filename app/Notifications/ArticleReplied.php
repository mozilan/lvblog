<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class ArticleReplied extends Notification implements ShouldQueue
{
    use Queueable;
    public $comment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        //
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // 开启通知的频道
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
//        Log::debug($this);
        $url = env('APP_URL').'/#/art/' .  $this->comment->article->id;

        return (new MailMessage)
            ->line('你的文章有新回复！')
            ->action('查看回复', $url);

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
