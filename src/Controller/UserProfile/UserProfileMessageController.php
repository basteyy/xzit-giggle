<?php
/**
 * Xzit Giggle
 *
 * This file `${FILE_NAME}` is part of the `xzit-giggle` project.
 * Xzit Giggle is available for use at your own risk and WITHOUT ANY WARRANTY.
 *
 * @license CC0 1.0 Universal
 * @website https://xzit.de/giggle
 * @author Sebastian Eiweleit <sebastian@eiweleit.de>
 * @since 08.11.2023
 */
declare(strict_types=1);

namespace basteyy\XzitGiggle\Controller\UserProfile;

use basteyy\XzitGiggle\Controller\BaseUserController;
use basteyy\XzitGiggle\Models\Message;
use basteyy\XzitGiggle\Models\MessageQuery;
use basteyy\XzitGiggle\Models\UserQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class UserProfileMessageController extends BaseUserController
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

        if (!$user) {
            return $this->render404(
                response: $response
            );
        }

        if ($user->getId() === $this->getUser()->getId()) {
            return $this->redirect(
                target: '/@'.$user->getUsername() . '/dialogs',
                response: $response
            );
        }

        $dialog = MessageQuery::create()
            ->filterByRecipientId([$user->getId(), $this->getUser()->getId()], Criteria::IN)
            ->filterBySenderId([$user->getId(), $this->getUser()->getId()], Criteria::IN)
            ->find();

        $message = new Message();
        $message->setSender($this->getUser());
        $message->setRecipient($user);

        if ($this->isPost()) {
            $message->setMessage($request->getParsedBody()['message']??'');

            // Errors
            $errors = [];

            if (strlen(trim($message->getMessage()))< 2) {
                $errors[] = __('The message is too short. At least 2 characters are required.');
            }

            // Check errors
            if (count($errors) === 0 ) {

                $message->save();

                return $this->reload(
                    response: $response
                );
            }

            $this->addInfoMessage(__('The message could not be sent'));
        }

        return $this->render(
            template: 'user/profil/dialog',
            data: [
                'user' => $user,
                'dialog' => $dialog,
                'message' => $message
            ],
            response: $response,
        );
    }
}