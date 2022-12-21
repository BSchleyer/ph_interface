<?php


class InvoiceController extends RouteTarget
{

    public function getList()
    {
        Functions::checkArray(["userid"], $_POST);
        $user = new UserNew($this->dependencyInjector, $_POST["userid"]);
        $sevDeskClient = new SevDeskApiClient($this->dependencyInjector);
        $sevDeskClient->createUser($user);
        $result = $sevDeskClient->getInvoiceList($user);
        $return = [];
        $ignoreNext = false;
        foreach ($result["objects"] as $incoice){
            if($ignoreNext){
                $ignoreNext = false;
                continue;
            }
            if (strpos($incoice["header"], 'Stornorechnung') !== false) {
                $ignoreNext = true;
                continue;
            }
            $return[] = [
                "id" => $incoice["id"],
                "date" => niceDate($incoice["create"]),
                "name" => $incoice["header"],
                "number" => $incoice["invoiceNumber"],
                "total" => niceNumber($incoice["sumGross"]),
                "left" => niceNumber($incoice["sumGross"] - $incoice["paidAmount"]),
                "status" => $incoice["status"],
            ];
        }
        $this->dependencyInjector->getResponse()->setresponse($return);
    }

    public function getDetailsPDF()
    {
        Functions::checkArray(["userid", "invoice"], $_POST);
        $user = new UserNew($this->dependencyInjector, $_POST["userid"]);
        $sevDeskClient = new SevDeskApiClient($this->dependencyInjector);

        $invoiceInfo = $sevDeskClient->getInvoice($_POST["invoice"]);
        $contactId = $invoiceInfo["objects"][0]["contact"]["id"];
        if($contactId != $user->getValue("sevdeskid")){
            $this->dependencyInjector->getResponse()->fail(403, "Nicht Ihre Rechnung");
        }

        $invoice = $sevDeskClient->getInvoicePDF($_POST["invoice"]);
        $this->dependencyInjector->getResponse()->setresponse($invoice["objects"]["content"]);
    }

    public function getDetails()
    {
        Functions::checkArray(["userid", "invoice"], $_POST);
        $user = new UserNew($this->dependencyInjector, $_POST["userid"]);
        $sevDeskClient = new SevDeskApiClient($this->dependencyInjector);

        $invoiceInfo = $sevDeskClient->getInvoice($_POST["invoice"]);
        $contactId = $invoiceInfo["objects"][0]["contact"]["id"];
        if($contactId != $user->getValue("sevdeskid")){
            $this->dependencyInjector->getResponse()->fail(403, "Nicht Ihre Rechnung");
        }
        $this->dependencyInjector->getResponse()->setresponse($invoiceInfo["objects"][0]);
    }

    public function deleteInvoice()
    {
        Functions::checkArray(["invoice"], $_POST);
        $sevDeskClient = new SevDeskApiClient($this->dependencyInjector);
        $sevDeskClient->changeStatusInvoice($_POST["invoice"],100);
        $sevDeskClient = new SevDeskApiClient($this->dependencyInjector);
        $sevDeskClient->deleteInvoice($_POST["invoice"]);
    }

    public function changeStatus()
    {
        Functions::checkArray(["invoice", "status"], $_POST);
        $sevDeskClient = new SevDeskApiClient($this->dependencyInjector);
        $sevDeskClient->changeStatusInvoice($_POST["invoice"],$_POST["status"]);
    }

}