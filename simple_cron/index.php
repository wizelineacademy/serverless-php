#!/usr/bin/env php
<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Output\OutputInterface;

use Aws\Exception\AwsException;
use App\Repository\UserRepository;
use App\Service\EmailService;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$app = new Silly\Application('Cron Manager');

$emailFrom=$_ENV['EMAIL_FROM'];
$emailsToSend=explode(',',$_ENV['EMAILS_TO_SEND']);
$emailsToReply=explode(',',$_ENV['EMAILS_TO_REPLY']);

$app->command('consume:rest', function ( OutputInterface $output) use($emailFrom,$emailsToSend,$emailsToReply){
    $userRepository = new UserRepository();
    $emailService = new EmailService();
    $usersDummies = $userRepository->getUsers();
    $output->writeln("Sending emails: ...");
    try {
        $body='<h1>List of users from server</h1><br><br>';
        foreach($usersDummies as $user){
            $body.= "
                <b>Name:</b>       {$user['name']}<br>
                <b>Last Name:</b>  {$user['lastName']}<br>
                <b>Age:</b>        {$user['age']}<br><br>
            ";
        }
        $result = $emailService->send($emailFrom,$emailsToSend, $emailsToReply,"Information from users",$body);
        $output->writeln("id: {$result['MessageId']} code: {$result['@metadata']['statusCode']}");
    } catch (AwsException $e) {
        error_log($e->getMessage());
        return 1;
    } 
    return 0;
});

$app->run();