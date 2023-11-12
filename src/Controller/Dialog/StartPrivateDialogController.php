<?php
/**
 * Xzit Giggle
 *
 * This file `StartPrivateDialogController.php` is part of the `xzit-giggle` project.
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
use basteyy\XzitGiggle\Models\Dialog;
use basteyy\XzitGiggle\Models\DialogQuery;
use basteyy\XzitGiggle\Models\DialogUser;
use basteyy\XzitGiggle\Models\UserQuery;
use DateTime;
use Propel\Runtime\Exception\PropelException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use function basteyy\Stringer\getRandomAlphaNumericString;

class StartPrivateDialogController extends BaseUserController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param string $username
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws PropelException
     * @throws \Exception
     */
    public function __invoke(RequestInterface  $request,
                             ResponseInterface $response,
                             string            $username): ResponseInterface
    {
        $this->setRequest($request);

        $user = UserQuery::create()
            ->findOneByUsername($username);

        if ($user === $this->getUser()) {
            $this->addErrorMessage(__('You can not write with yourself.'));
            return $this->redirect(
                target: '/@' . $user->getUsername() . '/dialogs/',
                response: $response,
            );
        }

        if ($user && $user->getDialogss()->count() > 0) {
            $dialog = DialogQuery::create()
                ->useDialogUserQuery()
                    ->filterByUserId($this->getUser()->getId())
                ->endUse()
                ->useDialogUserQuery('DialogUserAgain')
                    ->filterByUserId($user->getId())
                ->endUse()
                ->filterByIsPrivate(true)
                ->findOne();

            return $this->redirect(
                target: '/@' . $this->getUser()->getUsername() . '/dialogs/?open=' . $dialog->getHash(),
                response: $response
            );
        }

        if ($this->isPost()) {

            $dialog = new Dialog();
            $dialog->setCreatedAt(new DateTime());
            $dialog->setActive(true);
            $dialog->setCreatedUserId($this->getUser()->getId());
            $dialog->setLastMessage(new DateTime());
            $dialog->setIsPrivate(true);
            $dialog->setSubject('Private Dialog ' . $user->getUsername() . ' and ' . $this->getUser()->getUsername());
            $dialog->setHash(getRandomAlphaNumericString(16));
            $dialog->save();

            // Add current user to dialog
            $dialogUser = new DialogUser();
            $dialogUser->setDialog($dialog);
            $dialogUser->setUser($this->getUser());
            $dialogUser->setJoinedAt(new DateTime());
            $dialogUser->setJoined(true);
            $dialogUser->save();

            // Add invited user to dialog
            $dialogUser = new DialogUser();
            $dialogUser->setDialog($dialog);
            $dialogUser->setUser($user);
            $dialogUser->setJoined(false);
            $dialogUser->setInvitedAt(new DateTime());
            $dialogUser->setInvitedUserId($this->getUser()->getId());
            $dialogUser->save();

            $this->addSuccessMessage(__('The dialog was created successfully. You can now write with the user.'));

            return $this->redirect(
                target: '/@' . $this->getUser()->getUsername() . '/dialogs/?open=' . $dialog->getHash(),
                response: $response
            );
        }

        return $this->render(
            template: 'users::dialogs/start_private_dialog',
            data: [
                'user' => $user
            ],
            response: $response
        );

    }
}