<?php
namespace App\Repository;

class EmailRepository{
    public function getEmails(){
        return     [
            [
                'subject'=> 'my first email',
                'body'=>'hello, this is my first email'
            ],
            [
                'subject'=> 'my second email',
                'body'=>'hello, this is my second email'
            ],
            [
                'subject'=> 'my third email',
                'body'=>'hello, this is my third email'
            ]
        ];
    }
}