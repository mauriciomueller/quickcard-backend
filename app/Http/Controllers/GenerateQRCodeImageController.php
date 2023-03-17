<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateQRCodeImageRequest;
use App\Services\QRCodeService;
use App\Services\UserQuickCardService;
use Illuminate\Http\Response;

class GenerateQRCodeImageController extends Controller
{
    public function __invoke(GenerateQRCodeImageRequest $request, UserQuickCardService $userQuickCardService, QRCodeService $qrCodeService): Response | JsonResponse
    {
        try {

            $requestValidated = $request->validated();

            $userQuickCard = $userQuickCardService->createUserQuickCard($requestValidated);

            $qrCodeUrl = url($userQuickCard->slug);

            $qrCode = $qrCodeService->generateQRCodeAsPNG($qrCodeUrl);

        } catch (DatabaseException $e) {
            return $this->sendErrorResponse(message: 'An internal server error occurred', code: 500);
        } catch (QRCodeGenerationException $e) {
            return $this->sendErrorResponse(message: 'An error occurred while generating the QR code', code: 500);
        }

        return $this->sendPNGResponse($qrCode);
    }
}
