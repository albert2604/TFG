<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Classes\Reserva;
use App\Models\ReservaModel;

class PaymentController extends BaseController
{
    protected $reservaModel;

    public function __construct()
    {
        $this->reservaModel = new ReservaModel();
    }
    public function checkout($reservaId)
    {
        $reserva = new Reserva($this->reservaModel->getReservaById($reservaId));
        $payload = array(
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => ['name' => $reserva->getFuncion()->getPelicula()->getTitulo()." (".count($reserva->getArrayButacas())." butacas)"],
                    'unit_amount' => $reserva->getFuncion()->getPrecio()*100
                ],
                'quantity' => count($reserva->getArrayButacas()),
            ]],
            'mode' => 'payment',
            'success_url' => base_url('payment/' . $reservaId . '/success'),
            'cancel_url' => base_url('payment/' . $reservaId . '/cancel')
        );
        
        Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
        $session = Session::create($payload);

        return redirect()->to($session->url);
    }

    public function success($reservaId)
    {   
        $this->reservaModel->editarReserva($reservaId, array('status' => 'completada'));
        return view('payments/payment_success');
    }

    public function cancel($reservaId)
    {   
        $this->reservaModel->editarReserva($reservaId, array('status' => 'cancelada', 'butacas' => []));
        return view('payments/payment_cancel');
    }

    public function webhook()
    {
        // Obtén el payload bruto y el encabezado de firma
        $payload = file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
        $endpointSecret = 'whsec_XXXXXXXXXXXXXXXXXXXXXXXX'; // <-- Reemplaza con tu secreto del endpoint
        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
        } catch (SignatureVerificationException $e) {
            // Firma inválida
            return $this->response->setStatusCode(400)->setBody('Firma no válida');
        }
        // Manejar el evento
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                // Aquí puedes actualizar el estado del pedido, activar servicios, etc.
                log_message('info', 'Pago completado. Session ID: ' . $session->id);
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                log_message('info', 'Pago exitoso. Intent ID: ' . $paymentIntent->id);
                break;
            // Agrega más casos según lo necesites
            default:
                log_message('notice', 'Evento recibido: ' . $event->type);
        }
        return $this->response->setStatusCode(200);
    }
}
