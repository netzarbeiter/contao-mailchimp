<?php

namespace Oneup\Contao\MailChimp\Module;

use Oneup\Contao\MailChimp\Model\MailChimpModel;

use Haste\Form\Form;
use Oneup\MailChimp\Client;

class ModuleSubscribe extends \Module
{
    protected $strTemplate = 'mod_mailchimp_subscribe';

    /** @var Client */
    protected $mailChimp;
    protected $objMailChimp;
    protected $mailChimpListId;

    public function generate()
    {
        if (TL_MODE == 'BE') {
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['mailchimp_subscribe'][0]) . ' ###';

            return $objTemplate->parse();
        }

        $this->objMailChimp = MailChimpModel::findByPk($this->mailchimpList);
        $this->mailChimp = new Client($this->objMailChimp->listApiKey);
        $this->mailChimpListId = $this->objMailChimp->listId;

        return parent::generate();
    }

    protected function compile()
    {
        \System::loadLanguageFile('tl_module');

        $objForm = new Form('mailchimp-subscribe', 'POST', function(Form $objHaste) {
            return \Input::post('FORM_SUBMIT') === $objHaste->getFormId();
        });

        $objForm->setFormActionFromUri(\Environment::get('request'));

        $objForm->addFormField('email', [
            'label' => $GLOBALS['TL_LANG']['tl_module']['mailchimp']['labelEmail'],
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'rgxp' => 'email',
                'placeholder' => $GLOBALS['TL_LANG']['tl_module']['mailchimp']['placeholderEmail'],
            ],
        ]);

        if (!!$this->mailchimpShowFirstname) {
            $objForm->addFormField('firstname', [
                'label' => $GLOBALS['TL_LANG']['tl_module']['mailchimp']['labelFirstname'],
                'inputType' => 'text',
                'eval' => [
                    'mandatory' => true,
                    'placeholder' => $GLOBALS['TL_LANG']['tl_module']['mailchimp']['placeholderFirstname'],
                ],
            ]);
        }

        if (!!$this->mailchimpShowLastname) {
            $objForm->addFormField('lastname', [
                'label' => $GLOBALS['TL_LANG']['tl_module']['mailchimp']['labelLastname'],
                'inputType' => 'text',
                'eval' => [
                    'mandatory' => true,
                    'placeholder' => $GLOBALS['TL_LANG']['tl_module']['mailchimp']['placeholderLastname'],
                ],
            ]);
        }

        $objForm->addFormField('submit', [
            'label' => $GLOBALS['TL_LANG']['tl_module']['mailchimp']['labelSubmit'],
            'inputType' => 'submit'
        ]);

        $objForm->addContaoHiddenFields();

        $this->Template->error = false;

        if ($objForm->validate()) {
            $arrData = $objForm->fetchAll();

            $mergeVars = [];

            if ($this->mailchimpShowFirstname) {
                $mergeVars['FNAME'] = $arrData['firstname'];
            }

            if ($this->mailchimpShowLastname) {
                $mergeVars['LNAME'] = $arrData['lastname'];
            }

            $subscribed = $this->mailChimp->subscribeToList(
                $this->mailChimpListId,
                $arrData['email'],
                $mergeVars,
                (boolean) $this->mailchimpOptin
            );

            if ($subscribed) {
                $this->jumpToOrReload($this->mailchimpJumpTo);
            } else {
                $this->Template->error = true;
                $this->Template->errorMsg = $GLOBALS['TL_LANG']['tl_module']['mailchimp']['subscribeError'];
            }
        }

        $form = new \stdClass();
        $objForm->addToObject($form);

        $this->Template->form = $form;
    }
}
