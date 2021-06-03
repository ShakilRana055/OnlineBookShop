<?php
    class AutoGenerate{

        public static function FormatString($number, $digitLength){
            $newNumber = null;
            for($i = 0; $i < $digitLength - strlen($number); $i ++){
                $newNumber .= "0";
            }
            return $newNumber.$number;
        }
        public static function PurchaseNumber($lastNumber, $invoiceType){
            $purchaseNumber = $invoiceType;
            $digitLength = 6;
            
            if($lastNumber == "0"){
                $purchaseNumber.= self::FormatString("1", $digitLength);
            }
            else{
                $number = explode("-", $lastNumber);
                $nextNumber = intval($number[1]) + 1;
                $purchaseNumber.= self::FormatString((string)$nextNumber, $digitLength);
            }
            return $purchaseNumber;
        }
    }
    //echo AutoGenerate::PurchaseNumber("INV-111003", "INV-");
?>