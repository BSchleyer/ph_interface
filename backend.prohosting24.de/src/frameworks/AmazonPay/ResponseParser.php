<?php
namespace AmazonPay;


    
    public function getBillingAgreementDetailsStatus($response)
    {
       $baStatus = $this->getStatus('GetBA', '
       
       return $baStatus;
    }
    
    private function getStatus($type, $path, $response) 
    {
       $data= new \SimpleXMLElement($response);
       $namespaces = $data->getNamespaces(true);
       foreach($namespaces as $key=>$value){
           $namespace = $value;
       }
       $data->registerXPathNamespace($type, $namespace);
       foreach ($data->xpath($path) as $value) {
           $status = json_decode(json_encode((array)$value), TRUE);
       }
       
       return $status;
    }
}
