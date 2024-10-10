<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\Contact;
use Alnv\MauticBundle\Library\Role;


class Registration {


    public function createNewUser( $objUserId, $arrSubmit, $objModule ) {

        if ( !$objModule->use_mautic ) {

            return null;
        }

        if ( !$objModule->mautic_create_contact ) {

            return null;
        }

        $objContact = new Contact();
        $arrData = [
            'email' => $arrSubmit['email']
        ];

        $objContact->addContact($arrData, [
            'addToSegment' => $objModule->mautic_add_to_segment,
            'segmentId' => $objModule->mautic_segment
        ]);
    }


    public function closeAccount( $objUserId, $stAct, $objModule ) {

        if ( !$objModule->use_mautic ) {

            return null;
        }

        if ( !$objModule->mautic_create_contact ) {

            return null;
        }

        if ( !FE_USER_LOGGED_IN ) {

            return null;
        }

        $arrSettings = [
            'addToSegment' => $objModule->mautic_add_to_segment,
            'segmentId' => $objModule->mautic_segment
        ];

        $objUser = \FrontendUser::getInstance();
        $this->createContact( $objUser->getData(), $arrSettings );
    }
}