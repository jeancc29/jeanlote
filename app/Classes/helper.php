<?php
namespace App\Classes;

use App\transactions;
use App\Types;

use Log;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

class Helper{
    public function saldo($id, $es_banca = true){
        $datos = Array("id" => $id, "es_banca" => $es_banca);

        $saldo_inicial = 0;

        if($datos["es_banca"] == 1){
            $idTipoEntidad1 = Types::where(['renglon' => 'entidad', 'descripcion' => 'Banca'])->first();
            $debito = transactions::where(
                [
                    'idEntidad1'=> $datos["id"], 
                    'idTipoEntidad1' => $idTipoEntidad1->id, 
                    'status' => 1
                ])->sum('debito');
            $credito =  transactions::where(
                [
                    'idEntidad1'=> $datos["id"], 
                    'idTipoEntidad1' => $idTipoEntidad1->id, 
                    'status' => 1
                ])->sum('credito');
            $saldo_inicial = $debito - $credito;
        }else{
            $idTipoEntidad2 = Types::where(['renglon' => 'entidad', 'descripcion' => 'Banco'])->first();
            $debito = transactions::where(
                [
                    'idEntidad2'=> $datos["id"],
                    'idTipoEntidad2' => $idTipoEntidad2->id,  
                    'status' => 1
                ])->sum('debito');
            $credito = transactions::where(
                [
                    'idEntidad2'=> $datos["id"],
                    'idTipoEntidad2' => $idTipoEntidad2->id,  
                    'status' => 1
                ])->sum('credito');
            $saldo_inicial = $credito - $debito;
        }

       return $saldo_inicial;
    }

    public function _sendSms($to, $codigoBarra, $sms = true)
    {
        $accountSid = config('twilio.TWILIO_SID');
        // $accountSid ='AC2380875a2809c90354752c05ab783704';
        $authToken = config('twilio.TWILIO_TOKEN');
        // $authToken = '6f48c6fcd85eac850dd032d2515ba79b';
        if($sms){
            $twilioNumber = config('twilio.TWILIO_SMS_NUMBER');
            $to ='+'. $to;
        }
        else{
            $twilioNumber ="whatsapp:" . config('twilio.TWILIO_WHATSAPP_NUMBER');
            $to ="whatsapp:" . '+'. $to;
        }

        $client = new Client($accountSid, $authToken);
        try {
            $client->messages->create(
                $to,
                [
                    "body" => "",
                    "from" => $twilioNumber,
                    'MediaUrl' => url('public/assets/ticket') . "\\" . $codigoBarra . "png"
                    //   On US phone numbers, you could send an image as well!
                    //  'mediaUrl' => $imageUrl
                ]
            );
            return array('errores' => 0, 'mensaje' => 'Message sent to ' . $twilioNumber);
            //Log::info('Message sent to ' . $twilioNumber);
        } catch (TwilioException $e) {
            // return 'Error ' . $e;
            return 'mensaje' . $e;
            Log::error(
                'Could not send SMS notification.' .
                ' Twilio replied with: ' . $e
            );
        }
    }


    function verificar_session()
    {
        if(!isset($_SESSION['idUsuario']))
        {
              header('location:' . url("login") );
        }

    }


}