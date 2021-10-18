<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Csrf\CsrfMiddleware;
use Mezzio\Flash\FlashMessageMiddleware;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Server\MiddlewareInterface;
use Valuation\Model\Table\ValuationTable;

class ValuationHandler implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    private $valuationTable;

    public function __construct(
        ValuationTable $valuationTable,
        TemplateRendererInterface $renderer
    ) {
        $this->valuationTable = $valuationTable;
        $this->renderer = $renderer;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        // Do some work...
        # add the signup_csrf value
        // $csrfToken = $request->getAttribute(CsrfMiddleware::GUARD_ATTRIBUTE);
        // $this->registerForm->get('signup_csrf')->setValue(
        //     $csrfToken->generateToken()
        // );
        $status = $request->getMethod();
        $flashMessages = null;

        # check if the request is a form post
        if ($request->getMethod() === 'POST') {

            $status = 'post_send';

            $dataForm = $request->getParsedBody();
            $response = $handler->handle($request);




            //$response->getStatusCode();

            if (!empty($dataForm['aktiva_id']) && !empty($dataForm['setConfidentiality'])) {
                $dataResponseStatus = $response->getStatusCode();
                $status = 'send OK';
                //return new RedirectResponse('/valuation/confidentiality/' . $dataForm['aktiva_id'], 302, ['status' => $status]);
            } else {
                //$flashMessages = $request->getAttribute(FlashMessageMiddleware::FLASH_ATTRIBUTE);
                //$flashMessages->flash('success', 'Account successfully created. You can now login');

                $flashMessages = 'OK';

                $status = 'není vybráno';
                //return new RedirectResponse('/login', 302,);
                //return new RedirectResponse('/valuation/confidentiality/' . $dataForm['aktiva_id'], 302, ['status' => $status]);
            }


            //return new RedirectResponse('/login');

            // $this->registerForm->setInputFilter($this->usersTable->getRegisterFormFilter());
            // $this->registerForm->setData($request->getParsedBody());

            // if ($this->registerForm->isValid()) {
            //     $this->usersTable->insertAccount($request->getParsedBody());
            //     $response = $handler->handle($request);

            //     $flashMessages = $request->getAttribute(FlashMessageMiddleware::FLASH_ATTRIBUTE);

            //     if ($response->getStatusCode() !== 302) {

            //         $flashMessages->flash('success', 'Account successfully created. You can now login');
            //         # because we have not created the login route yet. We will redirect to the home page
            //         return new RedirectResponse('/login');
            //     }

            //     return $response;
            // }

        }

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::valuation',
            [
                'echo' => $this->valuationTable->fetchAllResources(),
                'testPOST' => $dataForm,
                'status' => $status,
                'flashMessages' => $flashMessages
            ] // parameters to pass to template
        ));
    }

    public function setConfidentialityAction()
    {
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'valuation::valuation',
            [
                //'echo' => $this->valuationTable->fetchAllResources()
            ] // parameters to pass to template
        ));
        //return new JsonResponse(['ack' => time()]);
    }

    public function createAction()
    {
        echo "pako";
        # ok now I am in the ProfileCOntroller
        # the reason I am here is because I want us to now display the profile picture

        // $id = (int) $this->params()->fromRoute('id');
        // $info = $this->usersTable->fetchAccountById((int) $id);
        // if (! $info) {
        //     return $this->notFoundAction();
        // }

        // return new ViewModel(['data' => $info]);

        return new HtmlResponse($this->renderer->render(
            'valuation::impact',
            [
                //'echo' => $this->valuationTable->fetchAllResources()
            ] // parameters to pass to template
        ));
    }
}
