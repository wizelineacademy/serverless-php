<?php
namespace App\Service;

use Aws\Ses\SesClient; 
use Aws\Result;

class EmailService{
    private $client;

    public function __construct(){
        $this->client = new SesClient([
            'version' => '2010-12-01',
            'region' => $_ENV['AWS_REGION'],
            'credentials' => [
                'key' => $_ENV['AWS_KEY'],
                'secret' => $_ENV['AWS_SECRET'],
          ]   
        ]);
    }

    public function send(string $sourceAddress,array $destinationAddresses, array $repplyAddresses,string $subject,string $body ):Result {
        return $this->client->sendEmail([
            'Destination' => [
                'ToAddresses' => $destinationAddresses,
            ],
            'ReplyToAddresses' => $repplyAddresses,
            'Source' => $sourceAddress,
            'Message' => [
    
                'Body' => [
                    'Html' => [
                        'Charset' => 'UTF-8',
                        'Data' => $body,
                    ],
                    'Text' => [
                        'Charset' => 'UTF-8',
                        'Data' => $body,
                    ],
                ],
                'Subject' => [
                    'Charset' => 'UTF-8',
                    'Data' => $subject,
                ],
            ],
        ]);
    }
}