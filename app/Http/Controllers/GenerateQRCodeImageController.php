<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateQRCodeImageRequest;
use App\Services\UserQueryCardService;
use Illuminate\Http\Response;

class GenerateQRCodeImageController extends Controller
{
    public function __invoke(GenerateQRCodeImageRequest $request, UserQueryCardService $userQueryCardService): Response | JsonResponse
    {
        try {

            $requestValidated = $request->validated();

            $userQueryCard = $userQueryCardService->createUserQueryCard($requestValidated);

            $qrCodeUrl = url($userQueryCard->slug);

            $qrCode = $userQueryCardService->generateQrCodeAsPNG($qrCodeUrl);

        } catch (DatabaseException $e) {
            return $this->sendErrorResponse(message: 'An internal server error occurred', code: 500);
        } catch (QRCodeGenerationException $e) {
            return $this->sendErrorResponse(message: 'An error occurred while generating the QR code', code: 500);
        }

        return $this->sendPNGResponse($qrCode);
    }
}
