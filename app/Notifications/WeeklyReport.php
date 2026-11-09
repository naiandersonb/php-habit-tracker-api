<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class WeeklyReport extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Collection $habits)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->markdown('mail.weekly-report', [
            'map' => $this->getMap()
        ]);
    }

    public function getMap(): string
    {

        $habitNames = $this->habits->groupBy('habit_name')->keys()->map(fn($name) => "$name | ")->implode(' ');

        $splitter = $this->habits->groupBy('habit_name')->keys()->map(fn($name) => ":------------: | ")->implode(' ');

        $days = $this->habits->groupBy('log_date')->map(function ($habit) {

            $day = $habit->first()->log_date->format('D j');

            $logs = $habit->map(fn($item) => ($item->completed ? '✓' : 'X') . ' |')->implode(' ');

            return <<<HTML

            | $day | $logs
            HTML;

        })->implode("\n");

        return <<<HTML

        |            | $habitNames
        | :--------: | $splitter
        $days
        HTML;

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
