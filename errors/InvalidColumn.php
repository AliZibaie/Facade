<?php

class InvalidColumn extends   Exception
{

    /**
     * @throws Exception
     */
    public static function throw()
    {
        throw  new  Exception('please add a valid column');
    }



}