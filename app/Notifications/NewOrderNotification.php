<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    // Définit les canaux de diffusion (Base de données et/ou Email)
    public function via($notifiable): array
    {
        return ['database']; // Vous pouvez ajouter 'mail' pour envoyer aussi un e-mail
    }

    // Structure stockée en Base de données (pour le tableau de bord Admin)
    public function toArray($notifiable): array
    {
        return [
            'type'       => 'new_order', // <--- Ajouter cette ligne
            'order_id'   => $this->order->id,
            'client_nom' => $this->order->client->nom ?? 'Client',
            'total'      => $this->order->total,
            'message'    => 'Nouvelle commande #' . $this->order->id . ' en attente de validation.',
        ];
    }
}