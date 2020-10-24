<?php

declare(strict_types=1);

namespace App\Responder;

use DarkMatter\Http\Response;
use DarkMatter\Responder\JsonResponder;
use DarkMatter\Payload\Payload;
use DarkMatter\Payload\Status;

class PayloadResponder extends JsonResponder
{
    /**
     * Generates response to a stopclock-action request.
     *
     * @param Payload $payload
     * @return Response
     */
    public function __invoke(Payload $payload): Response
    {
        $payloadResult = $payload->getResult();
        if ($payload->getStatus() === Status::FOUND) {
            return $this->found($payloadResult);
        }

        return $this->error([$payloadResult['error'] ?? 'Unknown Error']);
    }
}