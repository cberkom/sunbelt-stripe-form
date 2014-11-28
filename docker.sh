#!/bin/bash

docker run -d -p 80:80 -v /home/cberkom/Sites/Sunbelt/payment-form:/var/www/html tutum/apache-php
