<?php

namespace App\Exception;

use App\Exceptions\Contracts\IPlatformException;
use Doctrine\DBAL\Exception\ConnectionException;
use Prugala\RequestDto\Exception\RequestValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ExceptionSubscriber
{

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $code = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode(): JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        $message = $exception->getMessage();

        if ($exception instanceof IPlatformException) {
            $code = $exception->getCode();
        } elseif ($exception instanceof RequestValidationException) {
            $message = $this->formatValidationErrors($exception->getViolationList());
        } elseif ($exception instanceof ConnectionException) {
            $message = 'Internal database connection error';
        }

        $responseData = [
            'error' => [
                'code' => $code,
                'message' => $message
            ]
        ];

        $event->allowCustomResponseCode();
        $event->setResponse(new JsonResponse($responseData));
    }

    private function formatValidationErrors(ConstraintViolationListInterface $violationList): array
    {
        $errors = [];

        foreach ($violationList as $violation) {
            $data = [
                'message' => $violation->getMessage(),
            ];

            if (!empty($violation->getPropertyPath())) {
                $data['context']['field'] = $violation->getPropertyPath();
            }

            $errors[] = $data;
        }

        return $errors;
    }

}