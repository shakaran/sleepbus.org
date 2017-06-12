#!/bin/bash

# convenience script to destroy any running containers
sudo docker rm -f sleepbussql
sudo docker rm -f sleepbusweb
sudo docker rm -f mailcatcher
sudo docker rm -f phpmyadmin
