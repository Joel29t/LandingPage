<?php

class EmailVerificationController
{

    public function __construct()
    {}

    public static function showEmailVerification($lastId)
    {
 
        EmailverificationView::showEmailverification($lastId);
    }
}