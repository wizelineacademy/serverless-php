# RestAPI using lambda Example
The Rest API has only one endpoint with the following URI:

```
/hello/{name}
```

# Requirements
- [Credentials in AWS](https://aws.amazon.com/es/console)
- [Serverless Framework](https://www.serverless.com)
- [Composer](https://getcomposer.org)
- PHP 7.2 or newer

# Run Locally

Copy .env.example to .env
```bash
cp .env.example .env
```

Fill the information on .env
```
AWS_KEY=xxxxxxxxxxxxxxxxxx
AWS_SECRET=xxxxxxxxxxxxxxxxx
AWS_REGION=us-east-2

EMAIL_FROM=your@email.com
EMAILS_TO_SEND=your@email.com,your@email.com,your@email.com
EMAILS_TO_REPLY=your@email.com,your@email.com,your@email.com
```

Install dependencies
```bash
composer install -o --prefer-dist
```

Execute command
```php
php index.php send:emails
```

# Deploy and execute on AWS

You need to add the emails to send in SES module because it is on [test mode](https://docs.bitnami.com/bch/how-to/use-ses).

Copy .env.example to .env
```bash
cp .env.example .env
```

Fill the information on .env
```
AWS_KEY=xxxxxxxxxxxxxxxxxx
AWS_SECRET=xxxxxxxxxxxxxxxxx
AWS_REGION=us-east-2

EMAIL_FROM=your@email.com
EMAILS_TO_SEND=your@email.com,your@email.com,your@email.com
EMAILS_TO_REPLY=your@email.com,your@email.com,your@email.com
```

Deploy to AWS
```bash
serverless deploy
```

Execute the deployed command from terminal
```bash
./vendor/bin/bref cli app-dev-hello --region=us-east-2 -- send:emails
```

Remove to AWS
```bash
serverless remove
```