<?php

namespace App\Exception;

use App\Exception\Constants\HTTPCodeResolver;
use App\Exceptions\Contracts\IPlatformException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [KernelEvents::EXCEPTION => 'onKernelException'];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof IPlatformException) {
            return;
        }

        $responseData = [
            'error' => [
                'code' => HTTPCodeResolver::ERROR_TYPE[$exception->getType()] ?? null,
                'message' => $exception->getMessage()
            ]
        ];

        $event->allowCustomResponseCode();
        $event->setResponse(new JsonResponse($responseData), 200);
    }
}