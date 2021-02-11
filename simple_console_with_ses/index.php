#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Output\OutputInterface;

use Aws\Exception\AwsException;
use App\Repository\EmailRepository;
use App\Service\EmailService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$app = new Silly\Application('Myfirst console Manager');

$emailFrom=$_ENV['EMAIL_FROM'];
$emailsToSend=explode(',',$_ENV['EMAILS_TO_SEND']);
$emailsToReply=explode(',',$_ENV['EMAILS_TO_REPLY']);

$app->command('send:emails', function ( OutputInterface $output) use($emailFrom,$emailsToSend,$emailsToReply){
    $emailRepository = new EmailRepository();
    $emailService = new EmailService();
    $emailsDummies = $emailRepository->getEmails();
    $output->writeln("Sending emails: ...");
    try {
        foreach($emailsDummies as $email){
            $result = $emailService->send($emailFrom,$emailsToSend, $emailsToReply,$email['subject'],$email['body'] );
            $output->writeln("id: {$result['MessageId']} code: {$result['@metadata']['statusCode']}");
        }
    } catch (AwsException $e) {
        error_log($e->getMessage());
        return 1;
    } 
    return 0;
});

$app->run();