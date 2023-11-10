<?php
/**
 * Xzit Giggle
 *
 * This file `UserDialogController.php` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\Dialog;

use basteyy\XzitGiggle\Controller\BaseUserController;
use basteyy\XzitGiggle\Models\DialogMessage;
use basteyy\XzitGiggle\Models\DialogQuery;
use basteyy\XzitGiggle\Models\UserQuery;
use Propel\Runtime\Exception\PropelException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class UserDialogController extends BaseUserController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param string $username
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws PropelException
     */
    public function __invoke(RequestInterface  $request,
                             ResponseInterface $response,
                             string            $username): ResponseInterface
    {
        $this->setRequest($request);

        $user = UserQuery::create()
            ->findOneByUsername($username);

        if (isset($request->getQueryParams()['open'])) {
            $dialog = DialogQuery::create()
                ->useDialogUserQuery()
                    ->filterByUserId($this->getUser()->getId())
                ->endUse()
                ->findOneByHash($request->getQueryParams()['open']);


            $message = new DialogMessage();
            $message->setDialogId($dialog->getId());
            $message->setUser($this->getUser());

            if ($this->isPost()) {


                $message->setMessage($request->getParsedBody()['message'] ?? '');

                // Errors
                $errors = [];

                if (strlen(trim($message->getMessage())) < 2) {
                    $errors[] = __('The message is too short. At least 2 characters are required.');
                }


                if (strlen(trim($message->getMessage())) > 2048) {
                    $errors[] = __('The message is too long. Maximum 2048 characters are allowed.');
                }

                // Check errors
                if (count($errors) === 0) {
                    $message->save();

                    // Update dialog
                    $dialog->setLastMessage(new \DateTime());
                    $dialog->save();

                    return $this->reload(
                        response: $response
                    );
                }

                $this->addInfoMessage(__('The message could not be sent'));

            }

        }

        return $this->render(
            template: 'user/dialogs/list_dialogs',
            data: [
                'dialog' => $dialog ?? null
            ],
            response: $response
        );
    }
}