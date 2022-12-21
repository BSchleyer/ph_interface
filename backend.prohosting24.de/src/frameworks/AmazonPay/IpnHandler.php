<?php
namespace AmazonPay;


    
    private function getRemainingIpnFields()
    {
        $ipnMessage = $this->returnMessage();

        $remainingFields = array(
                            'NotificationReferenceId' =>$ipnMessage['NotificationReferenceId'],
                            'NotificationType' =>$ipnMessage['NotificationType'],
                            'SellerId' =>$ipnMessage['SellerId'],
                            'ReleaseEnvironment' =>$ipnMessage['ReleaseEnvironment'] );

        return $remainingFields;
    }

    private function sanitizeResponseData($input)
    {

        $patterns = array();
        $patterns[0] = '/(<SellerNote>)(.+)(<\/SellerNote>)/ms';
        $patterns[1] = '/(<AuthorizationBillingAddress>)(.+)(<\/AuthorizationBillingAddress>)/ms';
        $patterns[2] = '/(<SellerAuthorizationNote>)(.+)(<\/SellerAuthorizationNote>)/ms';
        $patterns[3] = '/(<SellerCaptureNote>)(.+)(<\/SellerCaptureNote>)/ms';
        $patterns[4] = '/(<SellerRefundNote>)(.+)(<\/SellerRefundNote>)/ms';

        $replacements = array();
        $replacements[0] = '$1 REMOVED $3';
        $replacements[1] = '$1 REMOVED $3';
        $replacements[2] = '$1 REMOVED $3';
        $replacements[3] = '$1 REMOVED $3';
        $replacements[4] = '$1 REMOVED $3';

        return preg_replace($patterns, $replacements, $input);
    }
}
