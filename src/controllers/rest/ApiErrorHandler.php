<?php
/**
 * @copyright Reinvently (c) 2017
 * @link http://reinvently.com/
 * @license https://opensource.org/licenses/Apache-2.0 Apache License 2.0
 */


namespace reinvently\ondemand\core\controllers\rest;


use reinvently\ondemand\core\components\statemachine\exceptions\InvalidStateException;
use reinvently\ondemand\core\components\statemachine\exceptions\StateTransitionException;
use reinvently\ondemand\core\exceptions\LogicException;
use yii\web\ConflictHttpException;
use yii\web\ErrorHandler;
use yii\web\HttpException;

class ApiErrorHandler extends ErrorHandler
{

    /**
     * @param \Exception $exception
     * @return array
     */
    protected function convertExceptionToArray($exception)
    {
        return \Yii::$app->transport
            ->responseException(
                parent::convertExceptionToArray($exception)
            );
    }

    /**
     * Renders the exception.
     * @param \Exception $exception the exception to be rendered.
     */
    protected function renderException($exception)
    {
        if ($exception instanceof LogicException) {
            if ($exception instanceof StateTransitionException) {
                $exception = new ConflictHttpException($exception->getMessage(), 0, $exception);
            } elseif ($exception instanceof InvalidStateException) {
                $exception = new ConflictHttpException($exception->getMessage(), 0, $exception);
            }
        }
        parent::renderException($exception);
    }
} 