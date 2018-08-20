#!/usr/bin/bash

read -p 'please input your email address: ' Email
ssh-keygen -t rsa -b 4096 -C $Email
