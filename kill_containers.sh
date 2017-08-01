#!/bin/bash

# convenience script to destroy any running containers
sudo docker rm -f {sleepbussql,sleepbusweb,mailcatcher,phpmyadmin}
