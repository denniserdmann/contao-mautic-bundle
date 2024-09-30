<?php

namespace Alnv\MauticBundle\Hooks;

use Alnv\MauticBundle\Library\Contact;
use Contao\Database;

class Newsletter {


    public function activateRecipient(string $email, array $recipientIds, array $channelIds) {
        foreach ($channelIds as $channelId) {
            $newsletterChannel = Database::getInstance()
                ->prepare("SELECT * FROM tl_newsletter_channel WHERE id = ?")
                ->execute($channelId)
                ->fetchAssoc();

            if ($newsletterChannel) {
                $addToSegment = $newsletterChannel['mautic_add_to_segment'];
                $segmentId = $newsletterChannel['mautic_segment'];

                if( !$addToSegment || !$segmentId ) {
                    return null;
                }
                
                $objContact = new Contact();
                $arrData = [
                    'email' => $email
                ];

                $objContact->addContact($arrData, [
                    'addToSegment' => $addToSegment,
                    'segmentId' => $segmentId
                ]);
            }
        }
    }


    public function removeFromNewsletter( $strEmail ) {

        if ( !\Config::get('mauticUseNewsletter') ) {

            return null;
        }

        if ( !\Config::get('mauticCreateNewsletterContact') ) {

            return null;
        }

        $arrData = [
            'email' => $strEmail
        ];

        $objContact = new Contact();
        $objContact->addContact( $arrData, [
            'addToSegment' => \Config::get('mauticAddSegmentOnRemoveRecipient') ? '1' : '',
            'segmentId' => \Config::get('mauticAddSegmentOnRemoveRecipient')
        ]);
    }
}